
@extends('layouts.app')

@section('title', 'Customers')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Customers</h1>
        <p class="text-muted mb-0">Manage laundry shop customers.</p>
    </div>
    <a href="{{ route('customers.create') }}" class="btn btn-primary">
        + Add Customer
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($customers as $customer)
                        <tr>
                            <td>{{ $customer->id }}</td>
                            <td class="fw-semibold">{{ $customer->name }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->email ?? '—' }}</td>
                            <td>{{ $customer->address ?? '—' }}</td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('customers.show', $customer) }}"
                                   class="btn btn-sm btn-outline-info">View</a>

                                <a href="{{ route('customers.edit', $customer) }}"
                                   class="btn btn-sm btn-outline-primary">Edit</a>

                                <form action="{{ route('customers.destroy', $customer) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Delete this customer?')">
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
                            <td colspan="6" class="text-center text-muted py-4">
                                No customers found. Add your first customer to begin.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $customers->links() }}
    </div>
</div>
@endsection
