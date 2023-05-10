@extends('layouts.app')

@section('title')
    Raw Material
@endsection

@section('content')
    <div class="bg-white shadow-lg rounded container">
        <h3 class="pt-4">Raw Material</h3>
        <div class="pull-right">
            <button id="myButton" class="btn btn-primary"></button>
            <button id="refresh" class="btn btn-secondary"></button>
        </div>
        @php
            $isHidden = true;
        @endphp
        @if ($isHidden)
            <div id="create" style="display: none">
                @livewire('add-raw-material')
            </div>
            <div class="container" id="table">
                <table id="raw_table" class="table table-bordered table-hover text-nowrap" style="width: 100%;">
                    <thead>
                        <tr>
                            <th class="text-center">Raw Material Name</th>
                            <th class="text-center">Standard Days</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        @endif
        <br>
    </div>

@endsection

@section('alt-scripts')
  <script>
    $(document).ready(function() {
      let farms = $('#raw_table').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        columnDefs: [{  className: "dt-center", targets: [0, 1, 2, 3] }],

        ajax: "{{ route('raw') }}",
        columns: [
            { data: 'raw_material_name', name: 'raw_material_name' },
            { data: 'standard_days', name: 'standard_days' },
            { data: 'category', name: 'category'},
            { data: 'action', name: 'action'}
        ],
        pagingType: 'full_numbers',
        language: {
            "emptyTable": "No Raw Material records."
        },
        searching: true,
      });
    });

    $(document).on('click', '#refresh', function(e) {
      var farms = $('#raw_table').DataTable();
      farms.ajax.reload();
    });

    $(document).on('click', '#update', function (e) {
      e.preventDefault();
      var id = $(this).data('id');
      var name = $(this).data('name');
      var title = "Update Raw Material?";
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
          var update_url = "{{ route('raw.update') }}"
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
      var title = "Remove Raw Material?";
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
          var update_url = "{{ route('raw.remove') }}"
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
