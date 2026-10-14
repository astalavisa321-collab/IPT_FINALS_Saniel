<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        $service = Service::query()->inRandomOrder()->first();

        return [
            'customer_id' => Customer::query()->inRandomOrder()->value('id')
                ?? Customer::factory(),

            'service_id' => $service?->id
                ?? Service::factory(),

            'employee_id' => Employee::query()->inRandomOrder()->value('id'),

            'weight_kg' => fake()->randomFloat(2, 1, 15),

            'total_amount' => $service
                ? round(fake()->randomFloat(2, 1, 15) * (float) $service->price_per_kg, 2)
                : 100,

            'order_date' => fake()->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),

            'expected_completion_date' => fake()->dateTimeBetween('now', '+3 days')->format('Y-m-d'),

            'status' => fake()->randomElement([
                'pending',
                'washing',
                'ready',
                'completed',
                'cancelled',
            ]),

            'notes' => fake()->optional()->sentence(),
        ];
    }
}
