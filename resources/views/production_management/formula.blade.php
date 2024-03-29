@extends('layouts.app')

@section('title')
	Formula
@endsection

@section('content')
	<h3>Formula</h3>
	<div class="pull-right">
        <button id="refresh" class="btn btn-secondary">Refresh</button>
    </div>
    <div class="container" id="table">
        <table id="farms" class="table table-bordered table-hover text-nowrap" style="width: 100%;">
            <thead>
                <tr>
                    <th class="text-center">Item Name</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
        </table>
    </div>
  </div>
@endsection

@section('alt-scripts')
  <script>
    $(document).ready(function() {
      let farms = $('#farms').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        columnDefs: [{  className: "dt-center", targets: [0, 1] }],

        ajax: "{{ route('formula') }}",
        columns: [
            { data: 'item_name', name: 'item_name' },
            { data: 'action', name: 'action', orderable: true }
        ],
        pagingType: 'full_numbers',
        language: {
        },
        searching: true,
        order: [[1, 'desc']] // Sort by 'action' column in ascending order
      });
    });

    $(document).on('click', '#refresh', function(e) {
      var farms = $('#farms').DataTable();
      farms.ajax.reload();
    });

    $(document).on('click', '#create', function (e) {
      e.preventDefault();
      var id = $(this).data('id');
      var name = $(this).data('name');
      var title = "Create Formula?";
      var html_text = "<p>Are you sure you want to create formula for <b>" + name + "</b>?</p>";
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
          var update_url = "{{ route('formula.update') }}"
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
      var title = "Remove Formula?";
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
          var update_url = "{{ route('formula.remove') }}"
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
