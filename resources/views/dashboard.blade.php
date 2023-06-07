@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="row mt-4">
        @livewire('view-charts-monthly', ['result' => $result])
    </div>
@endsection
@section('scripts')
@endsection
