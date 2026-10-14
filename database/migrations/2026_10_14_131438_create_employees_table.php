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
    Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('phone', 30);
        $table->string('email')->nullable()->unique();
        $table->string('position')->default('Staff');
        $table->string('status')->default('active');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('employees');
}
};
