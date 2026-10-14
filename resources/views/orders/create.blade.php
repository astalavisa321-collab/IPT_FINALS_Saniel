@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Create Laundry Order</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                @include('orders._form', ['buttonText' => 'Create Order'])
            </form>
        </div>
    </div>
@endsection
