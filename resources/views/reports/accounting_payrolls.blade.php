@extends('layouts.app')

@section('title')
    Accounting Payrolls
@endsection

@section('content')
    <div class="bg-white shadow-lg rounded container">
        <h3 class="pt-4">Accounting Payrolls</h3>
        <div class="">
            @livewire('add-payroll')
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
  </script>
@endsection
