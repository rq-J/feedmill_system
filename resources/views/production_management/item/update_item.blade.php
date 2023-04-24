@extends('layouts.app')

@section('title')
	Item
@endsection

@section('content')
	<h3>Update Item</h3>
    <div>
        @livewire('update-item', ['id' => $id])
    </div>
@endsection

@section('alt-scripts')
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
