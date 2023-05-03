@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    {{-- #[ ]: apply to all - bg-white shadow-lg rounded --}}
    <div class="bg-white shadow-lg rounded">
        <div class="container pt-4">
            <h3>Feed Request</h3>
        </div>
        <div>
            @livewire('add-weekly-request')
        </div>
    </div>
@endsection

@section('scripts')

@endsection
