@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Add Employee</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('employees.store') }}" method="POST">
                @csrf
                @include('employees._form', ['buttonText' => 'Save Employee'])
            </form>
        </div>
    </div>
