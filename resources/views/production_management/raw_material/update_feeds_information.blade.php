@extends('layouts.app')

@section('title')
    Raw Material - Update
@endsection

@section('content')
    @livewire("update-raw-material", ['id' => $id])
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
@endsection
