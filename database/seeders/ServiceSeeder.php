<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Wash and Fold',
                'description' => 'Standard washing and folding service.',
                'price_per_kg' => 35,
                'turnaround_hours' => 24,
                'is_active' => true,
            ],
            [
                'name' => 'Wash and Iron',
                'description' => 'Laundry washed, dried, and ironed.',
                'price_per_kg' => 50,
                'turnaround_hours' => 24,
                'is_active' => true,
            ],
            [
                'name' => 'Express Laundry',
                'description' => 'Priority laundry service.',
                'price_per_kg' => 70,
                'turnaround_hours' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'Blanket Cleaning',
                'description' => 'Cleaning service for blankets.',
                'price_per_kg' => 60,
                'turnaround_hours' => 48,
                'is_active' => true,
            ],
            [
                'name' => 'Premium Laundry',
                'description' => 'Premium garment care service.',
                'price_per_kg' => 85,
                'turnaround_hours' => 48,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            \App\Models\Service::firstOrCreate(
                ['name' => $service['name']],
                $service
            );
        }
    }
}
