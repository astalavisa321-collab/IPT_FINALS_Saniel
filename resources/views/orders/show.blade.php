@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Order #{{ $order->id }}</h1>
        <div>
            <a href="{{ route('orders.edit', $order) }}" class="btn btn-warning">Edit Order</a>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Order Information</div>
        <div class="card-body">
            <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
            <p><strong>Phone:</strong> {{ $order->customer->phone }}</p>
            <p><strong>Service:</strong> {{ $order->service->name }}</p>
            <p><strong>Price per kg:</strong> ₱{{ number_format($order->service->price_per_kg, 2) }}</p>
            <p><strong>Weight:</strong> {{ $order->weight_kg }} kg</p>
            <p><strong>Total Amount:</strong> ₱{{ number_format($order->total_amount, 2) }}</p>
            <p><strong>Assigned Employee:</strong> {{ $order->employee->name ?? 'Unassigned' }}</p>
            <p><strong>Order Date:</strong> {{ $order->order_date->format('M d, Y') }}</p>
            <p><strong>Expected Completion:</strong>
                {{ $order->expected_completion_date ? $order->expected_completion_date->format('M d, Y') : 'Not set' }}
            </p>
            <p><strong>Status:</strong>
                <span class="badge bg-info">{{ ucfirst($order->status) }}</span>
            </p>
            <p><strong>Notes:</strong> {{ $order->notes ?: 'None' }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Payments for This Order</div>
        <div class="card-body">
            @if ($order->payments->isEmpty())
                <p>No payments recorded for this order.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Date Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>₱{{ number_format($payment->amount, 2) }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $payment->method)) }}</td>
                                    <td>{{ ucfirst($payment->status) }}</td>
                                    <td>{{ $payment->paid_at ? $payment->paid_at->format('M d, Y h:i A') : 'Not paid' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <a href="{{ route('payments.create') }}" class="btn btn-success">Record a Payment</a>
        </div>
    </div>
@endsection
