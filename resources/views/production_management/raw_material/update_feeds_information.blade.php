@extends('layouts.app')

@section('title')
    Raw Material - Update
@endsection

@section('content')
    {{-- <h3>Raw Ingredients</h3> --}}
    @livewire("update-raw-material", ['id' => $id])
    {{-- {{ $raw_material }} --}}
    {{-- {{ $array['id'] }} --}}
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
@endsection
