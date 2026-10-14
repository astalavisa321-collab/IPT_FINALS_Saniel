
@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
<div class="mb-4">
    <h1 class="h3">Edit Customer</h1>
    <p class="text-muted">Update the customer's information.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('customers.update', $customer) }}" method="POST">
            @csrf
            @method('PUT')
            @include('customers._form', ['buttonText' => 'Update Customer'])
        </form>
    </div>
</div>
@endsection
