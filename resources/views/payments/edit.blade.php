@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit Payment #{{ $payment->id }}</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('payments.update', $payment) }}" method="POST">
                @csrf
                @method('PUT')
                @include('payments._form', ['buttonText' => 'Update Payment'])
            </form>
        </div>
    </div>
@endsection
