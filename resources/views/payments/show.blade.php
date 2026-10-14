@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Payment #{{ $payment->id }}</h1>
        <div>
            <a href="{{ route('payments.edit', $payment) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('payments.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Payment Information</div>
        <div class="card-body">
            <p><strong>Payment ID:</strong> {{ $payment->id }}</p>
            <p><strong>Order:</strong>
                <a href="{{ route('orders.show', $payment->order) }}">
                    Order #{{ $payment->order_id }}
                </a>
            </p>
            <p><strong>Customer:</strong> {{ $payment->order->customer->name }}</p>
            <p><strong>Order Total:</strong> ₱{{ number_format($payment->order->total_amount, 2) }}</p>
            <p><strong>Payment Amount:</strong> ₱{{ number_format($payment->amount, 2) }}</p>
            <p><strong>Method:</strong> {{ ucfirst(str_replace('_', ' ', $payment->method)) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
            <p><strong>Date Paid:</strong>
                {{ $payment->paid_at ? $payment->paid_at->format('M d, Y h:i A') : 'Not paid' }}
            </p>
            <p><strong>Reference Number:</strong> {{ $payment->reference_number ?: 'None' }}</p>
        </div>
    </div>
@endsection
