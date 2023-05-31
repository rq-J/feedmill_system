@extends('layouts.app')

@section('title')
    Production Order
@endsection

@section('content')
    <div class="bg-white shadow-lg rounded container">
        <h3 class="pt-4">Production Data</h3>
        <br>
        <div>
            @livewire('add-production-data')
        </div>
    </div>

    <br>
@endsection

@section('scripts')

@endsection
