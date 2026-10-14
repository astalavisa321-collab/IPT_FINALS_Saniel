@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Employee Details</h1>
        <div>
            <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Employee Information</div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $employee->name }}</p>
            <p><strong>Phone:</strong> {{ $employee->phone }}</p>
            <p><strong>Email:</strong> {{ $employee->email ?: 'Not provided' }}</p>
            <p><strong>Position:</strong> {{ $employee->position }}</p>
            <p><strong>Status:</strong> {{ ucfirst($employee->status) }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Assigned Orders</div>
        <div class="card-body">
            @if ($employee->orders->isEmpty())
                <p>No orders have been assigned to this employee.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employee->orders as $order)
                            <tr>
                                <td>
                                    <a href="{{ route('orders.show', $order) }}">#{{ $order->id }}</a>
                                </td>
                                <td>{{ $order->customer->name }}</td>
                                <td>{{ $order->service->name }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
