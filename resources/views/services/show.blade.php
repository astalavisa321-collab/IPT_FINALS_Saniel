@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Service Details</h1>
        <div>
            <a href="{{ route('services.edit', $service) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('services.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Laundry Service Information</div>
        <div class="card-body">
            <p><strong>Service Name:</strong> {{ $service->name }}</p>
            <p><strong>Description:</strong> {{ $service->description ?: 'No description' }}</p>
            <p><strong>Price per kg:</strong> ₱{{ number_format($service->price_per_kg, 2) }}</p>
            <p><strong>Turnaround Time:</strong> {{ $service->turnaround_hours }} hours</p>
            <p><strong>Status:</strong> {{ $service->is_active ? 'Active' : 'Inactive' }}</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">Orders Using This Service</div>
        <div class="card-body">
            @if ($service->orders->isEmpty())
                <p>No orders use this service yet.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Weight</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($service->orders as $order)
                            <tr>
                                <td>
                                    <a href="{{ route('orders.show', $order) }}">#{{ $order->id }}</a>
                                </td>
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->weight_kg }} kg</td>
                                <td>₱{{ number_format($order->total_amount, 2) }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
