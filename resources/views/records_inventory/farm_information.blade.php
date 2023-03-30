@extends('layouts.app')

@section('title')
    Farm Information
@endsection

@section('content')
    <h3>Farm Information</h3>
    <div class="row">
        <div class="col-6">
            <div class="row">
                <h4 class="col-8">Farm</h4>
                <a href="{{ route('farm.f') }}" class="btn btn-primary col-4">Create</a>
            </div>
            {{-- <livewire:farm-table /> --}}
        </div>
        <div class="col-6">
            <div class="row">
                <h4 class="col-8">Farm Location</h4>
                <a href="{{ route('farm.l') }}" class="btn btn-primary col-4">Create</a>
            </div>
            {{-- <livewire:farm-location-table /> --}}
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        @if(session('success_message'))
            Swal.fire({
                title: 'Done!',
                text: '{{ session('success_message') }}',
                icon: 'success',
                timer: 3000,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Close'
            });
        @elseif(session('danger_message'))
            Swal.fire({
                title: 'Done!',
                text: '{{session('danger_message') }}',
                icon: 'error',
                timer: 3000,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            });
        @endif

        @error('task')
            Swal.fire({
                title: 'Invalid Input!',
                text: '',
                icon: 'error',
                timer: 3000,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            });
        @enderror

        @if(isset($_GET['action']) && $_GET['action'] == 'cancelled')
            Swal.fire({
                title: 'Action Cancelled!',
                text: '',
                icon: 'error',
                timer: 3000,
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            });
        @endif
    </script>
@endsection
