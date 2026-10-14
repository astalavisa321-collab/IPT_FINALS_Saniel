@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Record Payment</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('payments.store') }}" method="POST">
                @csrf
                @include('payments._form', ['buttonText' => 'Save Payment'])
            </form>
        </div>
    </div>
@endsection
