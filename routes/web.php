
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return redirect()->route('orders.index');
});

Route::resource('customers', CustomerController::class);
Route::resource('services', ServiceController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('orders', OrderController::class);
Route::resource('payments', PaymentController::class);
