<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'service', 'employee'])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $services = Service::where('is_active', true)->orderBy('name')->get();
        $employees = Employee::where('status', 'active')->orderBy('name')->get();

        return view('orders.create', compact(
            'customers',
            'services',
            'employees'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'service_id' => ['required', 'exists:services,id'],
            'employee_id' => ['nullable', 'exists:employees,id'],
            'weight_kg' => ['required', 'numeric', 'gt:0', 'max:999999'],
            'order_date' => ['required', 'date'],
            'expected_completion_date' => [
                'nullable',
                'date',
                'after_or_equal:order_date',
            ],
            'status' => [
                'required',
                'in:pending,washing,ready,completed,cancelled',
            ],
            'notes' => ['nullable', 'string'],
        ]);

        $service = Service::findOrFail($validated['service_id']);

        $validated['total_amount'] = round(
            (float) $validated['weight_kg'] * (float) $service->price_per_kg,
            2
        );

        Order::create($validated);

        return redirect()->route('orders.index')
            ->with('success', 'Laundry order created successfully.');
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'service', 'employee', 'payments']);

        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $customers = Customer::orderBy('name')->get();
        $services = Service::orderBy('name')->get();
        $employees = Employee::orderBy('name')->get();

        return view('orders.edit', compact(
            'order',
            'customers',
            'services',
            'employees'
        ));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'service_id' => ['required', 'exists:services,id'],
            'employee_id' => ['nullable', 'exists:employees,id'],
            'weight_kg' => ['required', 'numeric', 'gt:0', 'max:999999'],
            'order_date' => ['required', 'date'],
            'expected_completion_date' => [
                'nullable',
                'date',
                'after_or_equal:order_date',
            ],
            'status' => [
                'required',
                'in:pending,washing,ready,completed,cancelled',
            ],
            'notes' => ['nullable', 'string'],
        ]);

        $service = Service::findOrFail($validated['service_id']);

        $validated['total_amount'] = round(
            (float) $validated['weight_kg'] * (float) $service->price_per_kg,
            2
        );

        $order->update($validated);

        return redirect()->route('orders.index')
            ->with('success', 'Laundry order updated successfully.');
    }

    public function destroy(Order $order)
    {
        if ($order->payments()->exists()) {
            return redirect()->route('orders.index')
                ->with('error', 'Cannot delete an order that has payment records.');
        }

        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Laundry order deleted successfully.');
    }
}
