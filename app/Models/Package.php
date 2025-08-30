<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'duration',
        'departure_city',
        'start_date',
        'end_date',
        'image',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
        'duration' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Scope to filter by price range
     */
    public function scopePriceRange($query, $range)
    {
        switch ($range) {
            case '<50000':
                return $query->where('price', '<', 50000);
            case '50000-100000':
                return $query->whereBetween('price', [50000, 100000]);
            case '>100000':
                return $query->where('price', '>', 100000);
            default:
                return $query;
        }
    }

    /**
     * Scope to filter by duration range
     */
    public function scopeDurationRange($query, $range)
    {
        switch ($range) {
            case '3-5':
                return $query->whereBetween('duration', [3, 5]);
            case '6-10':
                return $query->whereBetween('duration', [6, 10]);
            case '>10':
                return $query->where('duration', '>', 10);
            default:
                return $query;
        }
    }

    /**
     * Scope to filter by departure city
     */
    public function scopeDepartureCity($query, $city)
    {
        return $query->where('departure_city', 'like', '%' . $city . '%');
    }

    /**
     * Scope to filter by date range overlap
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->where(function ($q) use ($startDate, $endDate) {
            $q->where(function ($subQ) use ($startDate, $endDate) {
                $subQ->where('start_date', '<=', $endDate)
                     ->where('end_date', '>=', $startDate);
            });
        });
    }

    /**
     * Scope to search in title
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%');
    }
}
