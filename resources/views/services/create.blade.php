@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Add Laundry Service</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('services.store') }}" method="POST">
                @csrf
                @include('services._form', ['buttonText' => 'Save Service'])
            </form>
        </div>
    </div>
@endsection
