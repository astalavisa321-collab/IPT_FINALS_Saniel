<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => fake()->numerify('09#########'),
            'email' => fake()->unique()->safeEmail(),
            'position' => fake()->randomElement([
                'Laundry Attendant',
                'Cashier',
                'Washer Operator',
                'Supervisor',
            ]),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
