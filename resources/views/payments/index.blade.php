@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Payments</h1>
        <a href="{{ route('payments.create') }}" class="btn btn-primary">+ Record Payment</a>
    </div>

    @if ($payments->isEmpty())
        <div class="alert alert-info">No payments have been recorded yet.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Status</th>
                        <th>Date Paid</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>#{{ $payment->order_id }}</td>
                            <td>{{ $payment->order->customer->name }}</td>
                            <td>₱{{ number_format($payment->amount, 2) }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $payment->method)) }}</td>
                            <td>
                                @if ($payment->status === 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @elseif ($payment->status === 'failed')
                                    <span class="badge bg-danger">Failed</span>
                                @elseif ($payment->status === 'refunded')
                                    <span class="badge bg-secondary">Refunded</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                            <td>{{ $payment->paid_at ? $payment->paid_at->format('M d, Y h:i A') : 'Not paid' }}</td>
                            <td>
                                <a href="{{ route('payments.show', $payment) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('payments.destroy', $payment) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Delete this payment?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $payments->links() }}
    @endif
@endsection
