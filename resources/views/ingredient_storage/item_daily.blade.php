@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <h3>Item Daily</h3>
    <div>
        @livewire('add-item-daily')
    </div>
@endsection

@section('alt-script')

@endsection
