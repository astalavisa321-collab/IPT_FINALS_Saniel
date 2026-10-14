@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit Employee</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('employees.update', $employee) }}" method="POST">
                @csrf
                @method('PUT')
                @include('employees._form', ['buttonText' => 'Update Employee'])
            </form>
        </div>
    </div>
@endsection
