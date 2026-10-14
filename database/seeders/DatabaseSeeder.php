<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CustomerSeeder::class,
            ServiceSeeder::class,
            EmployeeSeeder::class,
            OrderSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
