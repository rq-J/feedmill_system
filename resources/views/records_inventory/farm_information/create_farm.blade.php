@extends('layouts.app')

@section('title')
    Farm Information
@endsection

@section('content')
    <div class="bg-white shadow-lg rounded container">
    <h3 class="pt-4">
        <a href="{{ route('farm') }}">
            <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="left"
                class="svg-inline--fa fa-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                <defs>
                    <style>
                        .fa-secondary {
                            opacity: .4
                        }
                    </style>
                </defs>
                <g class="fa-group">
                    <path d="M448 224V288C448 305.674 433.674 320 416 320H224V192H416C433.674 192 448 206.328 448 224Z"
                        class="fa-secondary" fill="currentColor" />
                    <path
                        d="M224 416C224 428.938 216.203 440.609 204.25 445.562C192.281 450.516 178.531 447.781 169.375 438.625L9.375 278.625C3.125 272.375 0 264.188 0 256S3.125 239.625 9.375 233.375L169.375 73.375C178.531 64.219 192.281 61.484 204.25 66.438C216.203 71.391 224 83.062 224 96V416Z"
                        class="fa-primary" fill="currentColor" />
                </g>
            </svg></a>&nbsp;Create Farm
    </h3>
    <div class="pull-right">
        <button id="myButton" class="btn btn-primary"></button>
        <button id="refresh" class="btn btn-secondary"></button>
    </div>

    @php
        $isHidden = true;
    @endphp
    @if ($isHidden)
        <div id="create" style="display: none">
            @livewire('add-farm')
        </div>
        <div class="container" id="table">
            {{-- <livewire:raw-material-table /> --}}
            {{-- TODO : insert data table here --}}
            <table id="farms" class="table table-bordered table-hover text-nowrap" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="text-center">Farm Name</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endif
    </div>

@endsection

@section('alt-scripts')
  <script>
    $(document).ready(function() {
      let farms = $('#farms').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        columnDefs: [{  className: "dt-center", targets: [0, 1, 2] }],

        ajax: "{{ route('farm.f') }}",
        columns: [
            { data: 'farm_name', name: 'farm_name' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action'}
        ],
        pagingType: 'full_numbers',
        language: {
            "emptyTable": "No Users available."
        },
        searching: true,
      });
    });

    $(document).on('click', '#refresh', function(e) {
      var farms = $('#farms').DataTable();
      farms.ajax.reload();
    });

    $(document).on('click', '#update', function (e) {
      e.preventDefault();
      var id = $(this).data('id');
      var name = $(this).data('name');
      var title = "Update Farm?";
      var html_text = "<p>Are you sure you want to update <b>" + name + "</b>?</p>";
      Swal.fire({
        title: title,
        html: html_text,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continue'
      }).then((result) => {
        if (result.value) {
          var update_url = "{{ route('farm.f.show') }}"
          window.location.replace(update_url + "/" + id);
        }
        else {
          Swal.fire({
            title: 'Action Cancelled',
            text: "",
            icon: 'info',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Close'
          });
        }
      });
    });

    $(document).on('click', '#remove', function (e) {
      e.preventDefault();
      var id = $(this).data('id');
      var title = "Remove Farm?";
      var name = $(this).data('name');
      var html_text = "<p>Are you sure you want to remove <b>" + name + "</b>?</p>";
      Swal.fire({
        title: title,
        html: html_text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Continue'
      }).then((result) => {
        if (result.value) {
          var update_url = "{{ route('farm.f.remove') }}"
          window.location.replace(update_url + "/" + id);
        }
        else {
          Swal.fire({
            title: 'Action Cancelled',
            text: "",
            icon: 'info',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Close'
          });
        }
      });
    });


    const button = document.getElementById("myButton");
    const create = document.getElementById("create");
    const table = document.getElementById("table");
    let isVisible = true;
    table.style.display = "block";
    button.innerText = "Create New";
    refresh.innerText = "Refresh";

    button.addEventListener("click", function() {
        if (isVisible) {
            create.style.display = "block";
            table.style.display = "none";
            refresh.style.display = "none";
            button.innerText = "Show Table";
            isVisible = false;
        } else {
            create.style.display = "none";
            table.style.display = "block";
            refresh.style.display = "inline";
            button.innerText = "Create New";
            isVisible = true;
        }
    });

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
