
@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Laundry Services</h1>
        <a href="{{ route('services.create') }}" class="btn btn-primary">+ Add Service</a>
    </div>

    @if ($services->isEmpty())
        <div class="alert alert-info">No services found. Add your first laundry service.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Service Name</th>
                        <th>Price per kg</th>
                        <th>Turnaround (Hours)</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->name }}</td>
                            <td>₱{{ number_format($service->price_per_kg, 2) }}</td>
                            <td>{{ $service->turnaround_hours }}</td>
                            <td>
                                @if ($service->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('services.show', $service) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('services.destroy', $service) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Delete this service?')">
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

        {{ $services->links() }}
    @endif
@endsection
