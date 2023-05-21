@extends('layouts.app')

@section('title')
    Pivot Logs
@endsection

@section('content')
    <div class="bg-white shadow-lg rounded container">
        <h3 class="pt-4">
            <a href="{{ route('pivot') }}">
                <svg aria-hidden="true" focusable="false" data-prefix="fa-duotone" data-icon="left"
                    class="svg-inline--fa fa-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 448 512">
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
                </svg>
            </a>&nbsp;Pivot Logs - Quality Assurance</h3>
        <div class="row">
            <div class="col-12">
                @livewire('add-quality-assurance')
            </div>
            <hr>
            <table id="quality_assurance" class="table table-bordered table-hover text-nowrap" width="100%">
                <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Description</th>
                    <th scope="col"></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function () {
      let quality_assurance = $('#quality_assurance').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        columnDefs: [{ className: "dt-center", targets: [0, 1, 2] }],
        order: [[0, 'desc']], // Order by the first column (index 0) in ascending order

        ajax: "{{ route('pivot.qa') }}",
        columns: [
          {data: 'code', name: 'code', orderable: true},
          {data: 'description', name: 'description', orderable: false, searchable: true},
          {data: 'action', name: 'action', orderable: false, seachable:false},

        ],
        pagingType: 'full_numbers',
        language: {
            "emptyTable": "No Quality Assurance Logs."
        },
        searching: true,
      });
    });


    $(document).on('click', '#refresh', function(e) {
      var quality_assurance = $('#quality_assurance').DataTable();
      quality_assurance.ajax.reload();
    });

    $(document).on('click', '#update', function (e) {
      e.preventDefault();
      var id = $(this).data('id');
      var name = $(this).data('name');
      var title = "Update Quality Assurance?";
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
          var update_url = "{{ route('pivot.qa.update') }}"
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
      var title = "Remove Item?";
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
          var update_url = "{{ route('pivot.qa.remove') }}"
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
  </script>
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
