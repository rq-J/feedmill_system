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
            {{-- TODO : insert data table here --}}
            <table id="farm" class="table table-bordered table-hover text-nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center">Farm Name</th>
                        <th class="text-center">Status</th>
                        {{-- <th class="text-center">Action</th> --}}
                    </tr>
                </thead>
            </table>


        </div>
        <div class="col-6">
            <div class="row">
                <h4 class="col-8">Farm Location</h4>
                <a href="{{ route('farm.l') }}" class="btn btn-primary col-4">Create</a>
            </div>
            {{-- <livewire:farm-location-table /> --}}
            {{-- TODO : insert data table here --}}

        </div>
    </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      let users = $('#farm').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        columnDefs: [{  className: "dt-center", targets: [0, 1] }],

        ajax: "{{ route('farm') }}",
        columns: [
            { data: 'farm_name', name: 'farm_name' },
            { data: 'status', name: 'status' },
        ],
        pagingType: 'full_numbers',
        language: {
            "emptyTable": "No Users available."
        },
        searching: true,
      });
    });

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
