@extends('layouts.app')

@section('title')
    Pivot Logs
@endsection

@section('content')
    <div class="bg-white shadow-lg rounded container">
        <h3 class="pt-4">Pivot Logs</h3>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <h4 class="col-8">Quality Assurance</h4>
                    <a href="{{ route('pivot.qa') }}" class="btn btn-primary col-4">Select</a>
                </div>
                {{-- <livewire:farm-table /> --}}
                {{-- TODO : insert data table here --}}

            </div>
            <div class="col-12">
                <div class="row">
                    <h4 class="col-8">Downtime</h4>
                    <a href="{{ route('pivot.dt') }}" class="btn btn-primary col-4">Select</a>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
