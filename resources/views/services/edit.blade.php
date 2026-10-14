@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit Service</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('services.update', $service) }}" method="POST">
                @csrf
                @method('PUT')
                @include('services._form', ['buttonText' => 'Update Service'])
            </form>
        </div>
    </div>
@endsection
