<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    public function definition(): array
    {
        $order = Order::query()->inRandomOrder()->first();

        $status = fake()->randomElement([
            'pending',
            'completed',
            'failed',
            'refunded',
        ]);

        return [
            'order_id' => $order?->id ?? Order::factory(),

            'amount' => $order
                ? round((float) $order->total_amount, 2)
                : 100,

            'method' => fake()->randomElement([
                'cash',
                'gcash',
                'bank_transfer',
            ]),

            'status' => $status,

            'paid_at' => $status === 'completed'
                ? fake()->dateTimeBetween('-30 days', 'now')
                : null,

            'reference_number' => fake()->optional()->bothify('PAY-########'),
        ];
    }
}
