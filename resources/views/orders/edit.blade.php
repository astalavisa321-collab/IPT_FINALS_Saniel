@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit Order #{{ $order->id }}</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')
                @include('orders._form', ['buttonText' => 'Update Order'])
            </form>
        </div>
    </div>
@endsection
