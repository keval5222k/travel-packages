<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use Carbon\Carbon;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = [
            [
                'title' => 'Bali Paradise Adventure',
                'description' => 'Experience the ultimate tropical getaway with pristine beaches, ancient temples, and vibrant culture. Includes luxury accommodation, guided tours, and authentic Balinese cuisine.',
                'price' => 85000.00,
                'duration' => 7,
                'departure_city' => 'Jakarta',
                'start_date' => '2024-03-15',
                'end_date' => '2024-03-22',
                'image' => 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?w=500&h=300&fit=crop',
            ],
            [
                'title' => 'Tokyo City Explorer',
                'description' => 'Discover the perfect blend of tradition and modernity in Japan\'s capital. Visit ancient shrines, experience cutting-edge technology, and savor world-class cuisine.',
                'price' => 120000.00,
                'duration' => 5,
                'departure_city' => 'Singapore',
                'start_date' => '2024-04-10',
                'end_date' => '2024-04-15',
                'image' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=500&h=300&fit=crop',
            ],
            [
                'title' => 'European Grand Tour',
                'description' => 'Journey through the heart of Europe visiting Paris, Rome, and Barcelona. Experience art, history, and culture across three magnificent cities.',
                'price' => 180000.00,
                'duration' => 12,
                'departure_city' => 'London',
                'start_date' => '2024-05-20',
                'end_date' => '2024-06-01',
                'image' => 'https://images.unsplash.com/photo-1499856871958-5b9627545d1a?w=500&h=300&fit=crop',
            ],
            [
                'title' => 'New York City Break',
                'description' => 'Experience the city that never sleeps with Broadway shows, iconic landmarks, and world-famous shopping. Perfect for a quick urban adventure.',
                'price' => 95000.00,
                'duration' => 4,
                'departure_city' => 'Toronto',
                'start_date' => '2024-06-15',
                'end_date' => '2024-06-19',
                'image' => 'https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?w=500&h=300&fit=crop',
            ],
            [
                'title' => 'Santorini Sunset Escape',
                'description' => 'Relax in the stunning Greek islands with white-washed buildings, crystal-clear waters, and breathtaking sunsets. Includes luxury villa accommodation.',
                'price' => 75000.00,
                'duration' => 6,
                'departure_city' => 'Athens',
                'start_date' => '2024-07-10',
                'end_date' => '2024-07-16',
                'image' => 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?w=500&h=300&fit=crop',
            ],
            [
                'title' => 'Machu Picchu Adventure',
                'description' => 'Trek through the Andes to discover the ancient Incan citadel. Experience rich history, stunning mountain views, and local Peruvian culture.',
                'price' => 65000.00,
                'duration' => 8,
                'departure_city' => 'Lima',
                'start_date' => '2024-08-05',
                'end_date' => '2024-08-13',
                'image' => 'https://images.unsplash.com/photo-1587595431973-160d0d94add1?w=500&h=300&fit=crop',
            ],
            [
                'title' => 'Dubai Luxury Experience',
                'description' => 'Indulge in opulence with desert safaris, world-class shopping, and iconic architecture. Stay in 5-star hotels and experience Arabian hospitality.',
                'price' => 110000.00,
                'duration' => 5,
                'departure_city' => 'Mumbai',
                'start_date' => '2024-09-20',
                'end_date' => '2024-09-25',
                'image' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?w=500&h=300&fit=crop',
            ],
            [
                'title' => 'Cape Town Safari & Wine',
                'description' => 'Combine wildlife safaris with world-renowned wine tasting. Visit Table Mountain, Robben Island, and the Cape of Good Hope.',
                'price' => 140000.00,
                'duration' => 10,
                'departure_city' => 'Johannesburg',
                'start_date' => '2024-10-15',
                'end_date' => '2024-10-25',
                'image' => 'https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?w=500&h=300&fit=crop',
            ],
            [
                'title' => 'Bangkok Street Food Tour',
                'description' => 'Immerse yourself in Thai culture with temple visits, floating markets, and the best street food in Asia. Experience authentic local life.',
                'price' => 45000.00,
                'duration' => 4,
                'departure_city' => 'Kuala Lumpur',
                'start_date' => '2024-11-10',
                'end_date' => '2024-11-14',
                'image' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?w=500&h=300&fit=crop',
            ],
            [
                'title' => 'Iceland Northern Lights',
                'description' => 'Chase the aurora borealis while exploring geysers, waterfalls, and volcanic landscapes. Experience the magic of Iceland\'s natural wonders.',
                'price' => 160000.00,
                'duration' => 7,
                'departure_city' => 'Reykjavik',
                'start_date' => '2024-12-01',
                'end_date' => '2024-12-08',
                'image' => 'https://images.unsplash.com/photo-1539066115647-9f3c1697d039?w=500&h=300&fit=crop',
            ],
        ];

        foreach ($packages as $package) {
            Package::create($package);
        }
    }
}
