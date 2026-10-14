<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Wash and Fold',
                'Wash and Iron',
                'Dry Cleaning',
                'Express Laundry',
                'Blanket Cleaning',
                'Premium Laundry',
            ]),
            'description' => fake()->sentence(),
            'price_per_kg' => fake()->randomFloat(2, 30, 100),
            'turnaround_hours' => fake()->randomElement([12, 24, 48, 72]),
            'is_active' => true,
        ];
    }
}
