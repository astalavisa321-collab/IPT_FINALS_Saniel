
@extends('layouts.app')

@section('title', 'Add Customer')

@section('content')
<div class="mb-4">
    <h1 class="h3">Add Customer</h1>
    <p class="text-muted">Enter the customer's information below.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('customers.store') }}" method="POST">
            @csrf
            @include('customers._form', ['buttonText' => 'Save Customer'])
        </form>
    </div>
</div>
@endsection
