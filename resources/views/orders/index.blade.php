@extends('layouts.app')

@section('title', 'Laundry Orders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Laundry Orders</h1>
        <p class="text-muted mb-0">Manage customer laundry transactions.</p>
    </div>
    <a href="{{ route('orders.create') }}" class="btn btn-primary">
        + New Order
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Weight (kg)</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->service->name }}</td>
                            <td>{{ number_format((float) $order->weight_kg, 2) }}</td>
                            <td>₱{{ number_format((float) $order->total_amount, 2) }}</td>
                            <td>
                                <span class="badge text-bg-secondary">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->order_date->format('M d, Y') }}</td>
                            <td class="text-nowrap">
                                <a href="{{ route('orders.show', $order) }}"
                                   class="btn btn-sm btn-outline-info">View</a>
                                <a href="{{ route('orders.edit', $order) }}"
                                   class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('orders.destroy', $order) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this order?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                No orders yet. Create your first laundry order.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $orders->links() }}
    </div>
</div>
@endsection
