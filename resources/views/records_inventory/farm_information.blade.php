@extends('layouts.app')

@section('title')
    Farm Information
@endsection

@section('content')
    <div class="bg-white shadow-lg rounded container">
        <h3 class="pt-4">Farm Information</h3>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <h4 class="col-8">Farm</h4>
                    <a href="{{ route('farm.f') }}" class="btn btn-primary col-4">Select</a>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <h4 class="col-8">Location</h4>
                    <a href="{{ route('farm.l') }}" class="btn btn-primary col-4">Select</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        @if (session('success_message'))
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
        @elseif (session('danger_message'))
            Swal.fire({
                title: 'Done!',
                text: '{{ session('danger_message') }}',
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

        @if (isset($_GET['action']) && $_GET['action'] == 'cancelled')
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
