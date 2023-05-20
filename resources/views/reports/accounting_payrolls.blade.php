@extends('layouts.app')

@section('title')
    Accounting Payrolls
@endsection

@section('content')
    <div class="bg-white shadow-lg rounded container">
        <h3 class="pt-4">Accounting Payrolls</h3>
        <div class="">
            @if (!$bool_month)
                @livewire('add-payroll')
            @endif
        </div>
        <div>
            <table id="payroll" class="table table-bordered table-hover text-nowrap" width="100%">
                <thead>
                <tr>
                    <th scope="col">Month and Year</th>
                    <th scope="col"></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('alt-scripts')
<script>
    $(document).ready(function () {
      let payroll = $('#payroll').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        columnDefs: [{ className: "dt-center", targets: [0, 1] }],
        order: [[0, 'desc']], // Order by the first column (index 0) in ascending order

        ajax: "{{ route('payrolls') }}",
        columns: [
          {data: 'month_and_year', name: 'month_and_year', orderable: true},
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        pagingType: 'full_numbers',
        language: {
            "emptyTable": "No Payroll Logs."
        },
        searching: true,
      });
    });


    $(document).on('click', '#refresh', function(e) {
      var payroll = $('#payroll').DataTable();
      payroll.ajax.reload();
    });

    $(document).on('click', '#update', function (e) {
      e.preventDefault();
      var id = $(this).data('id');
      var name = $(this).data('name');
      var title = "View Payroll?";
      var html_text = "<p>Are you sure you want to view <b>" + name + "</b>?</p>";
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
          var update_url = "{{ route('payrolls.view') }}"
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
          var update_url = "{{ route('payrolls.remove') }}"
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
