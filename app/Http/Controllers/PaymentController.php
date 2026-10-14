<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('order.customer')
            ->latest()
            ->paginate(10);

        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $orders = Order::with('customer')
            ->whereIn('status', ['pending', 'washing', 'ready', 'completed'])
            ->latest()
            ->get();

        return view('payments.create', compact('orders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => ['required', 'exists:orders,id'],
            'amount' => ['required', 'numeric', 'gt:0', 'max:99999999.99'],
            'method' => [
                'required',
                Rule::in(['cash', 'gcash', 'bank_transfer']),
            ],
            'status' => [
                'required',
                Rule::in(['pending', 'completed', 'failed', 'refunded']),
            ],
            'paid_at' => ['nullable', 'date'],
            'reference_number' => ['nullable', 'string', 'max:255'],
        ]);

        Payment::create($validated);

        return redirect()->route('payments.index')
            ->with('success', 'Payment recorded successfully.');
    }

    public function show(Payment $payment)
    {
        $payment->load('order.customer');

        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $orders = Order::with('customer')->latest()->get();

        return view('payments.edit', compact('payment', 'orders'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'order_id' => ['required', 'exists:orders,id'],
            'amount' => ['required', 'numeric', 'gt:0', 'max:99999999.99'],
            'method' => [
                'required',
                Rule::in(['cash', 'gcash', 'bank_transfer']),
            ],
            'status' => [
                'required',
                Rule::in(['pending', 'completed', 'failed', 'refunded']),
            ],
            'paid_at' => ['nullable', 'date'],
            'reference_number' => ['nullable', 'string', 'max:255'],
        ]);

        Payment::whereKey($payment->id)->update($validated);

        return redirect()->route('payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment deleted successfully.');
    }
}
