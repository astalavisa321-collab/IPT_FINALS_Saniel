
@extends('layouts.app')

@section('title', 'Customer Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Customer Details</h1>
        <p class="text-muted mb-0">Customer #{{ $customer->id }}</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('customers.edit', $customer) }}"
           class="btn btn-primary">Edit</a>
        <a href="{{ route('customers.index') }}"
           class="btn btn-outline-secondary">Back</a>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-4">
        <h2 class="h5 mb-3">{{ $customer->name }}</h2>
        <p><strong>Phone:</strong> {{ $customer->phone }}</p>
        <p><strong>Email:</strong> {{ $customer->email ?? '—' }}</p>
        <p><strong>Address:</strong> {{ $customer->address ?? '—' }}</p>
        <p class="mb-0">
            <strong>Registered:</strong> {{ $customer->created_at->format('M d, Y') }}
        </p>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h2 class="h5 mb-0">Customer Orders</h2>
    </div>
    <div class="card-body">
        @forelse ($customer->orders as $order)
            <div class="border-bottom py-2">
                <a href="{{ route('orders.show', $order) }}">
                    Order #{{ $order->id }}
                </a>
                — {{ $order->status }}
                — ₱{{ number_format((float) $order->total_amount, 2) }}
            </div>
        @empty
            <p class="text-muted mb-0">This customer has no orders yet.</p>
        @endforelse
    </div>
</div>
@endsection
