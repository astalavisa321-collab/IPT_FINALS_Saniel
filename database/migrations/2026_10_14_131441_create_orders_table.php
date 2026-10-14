<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();

        $table->foreignId('customer_id')
            ->constrained('customers')
            ->restrictOnDelete();

        $table->foreignId('service_id')
            ->constrained('services')
            ->restrictOnDelete();

        $table->foreignId('employee_id')
            ->nullable()
            ->constrained('employees')
            ->nullOnDelete();

        $table->decimal('weight_kg', 8, 2);
        $table->decimal('total_amount', 10, 2);
        $table->date('order_date');
        $table->date('expected_completion_date')->nullable();

        $table->enum('status', [
            'pending',
            'washing',
            'ready',
            'completed',
            'cancelled',
        ])->default('pending');

        $table->text('notes')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('orders');
}
};
