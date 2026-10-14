@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Employees</h1>
        <a href="{{ route('employees.create') }}" class="btn btn-primary">+ Add Employee</a>
    </div>

    @if ($employees->isEmpty())
        <div class="alert alert-info">No employees found. Add your first employee.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <td>{{ $employee->id }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->email ?: '—' }}</td>
                            <td>{{ $employee->position }}</td>
                            <td>
                                @if ($employee->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('employees.destroy', $employee) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Delete this employee?')">
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

        {{ $employees->links() }}
    @endif
@endsection
