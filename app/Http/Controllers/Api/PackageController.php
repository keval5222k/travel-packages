<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PackageResource;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PackageController extends Controller
{
    /**
     * Display a listing of packages with filters
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $query = Package::query();

        // Apply price range filter
        if ($request->has('price_range') && $request->price_range) {
            $query->priceRange($request->price_range);
        }

        // Apply duration range filter
        if ($request->has('duration') && $request->duration) {
            $query->durationRange($request->duration);
        }

        // Apply departure city filter
        if ($request->has('departure_city') && $request->departure_city) {
            $query->departureCity($request->departure_city);
        }

        // Apply date range filter
        if ($request->has('start_date') && $request->has('end_date') && 
            $request->start_date && $request->end_date) {
            $query->dateRange($request->start_date, $request->end_date);
        }

        // Apply search filter
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        $packages = $query->get();

        return response()->json([
            'success' => true,
            'data' => PackageResource::collection($packages),
            'count' => $packages->count(),
        ]);
    }

    /**
     * Display the specified package
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $package = Package::find($id);

        if (!$package) {
            return response()->json([
                'success' => false,
                'message' => 'Package not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => new PackageResource($package)
        ]);
    }

    /**
     * Get unique departure cities for filter dropdown
     *
     * @return JsonResponse
     */
    public function getDepartureCities(): JsonResponse
    {
        $cities = Package::distinct()
            ->pluck('departure_city')
            ->sort()
            ->values();

        return response()->json([
            'success' => true,
            'data' => $cities
        ]);
    }
}
