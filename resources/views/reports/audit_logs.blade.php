@extends('layouts.app')

@section('title')
	Audit Logs
@endsection

@section('content')
	<h3>Audit Logs</h3>

    {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Audit Trail') }} <button id="refresh" class="btn btn-link text-decoration-none"><i class="fa fa-sync"></i> REFRESH</button>
    </h2> --}}

    <div class="py-2">
        <div class="container">
            <div style="padding:10px">
                <div class="row">
                    <div class="col-md-12">
                    <table id="audits" class="table table-bordered table-hover text-nowrap" width="100%">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User</th>
                            <th scope="col">Table</th>
                            <th scope="col">Action</th>
                            <th scope="col">New Value</th>
                            <th scope="col">Old Value</th>
                            <th scope="col">View</th>
                        </tr>
                        </thead>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function () {
      let audits = $('#audits').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        columnDefs: [{ className: "dt-center", targets: [0, 1, 2, 3, 4, 5, 6] }],

        ajax: "{{ route('audit') }}",
        columns: [
          {data: 'id', name: 'id'},
          {data: 'user', name: 'user'},
          {data: 'table', name: 'table'},
          {data: 'action', name: 'action'},
          {data: 'new_value', name: 'new_value'},
          {data: 'old_value', name: 'old_value'},
          {data: 'view', name: 'view', orderable: false, searchable: false},
        ],
        pagingType: 'full_numbers',
        language: {
            "emptyTable": "No Audit Logs."
        },
        searching: true,
      });
    });


    $(document).on('click', '#refresh', function(e) {
      var audits = $('#audits').DataTable();
      audits.ajax.reload();
    });
  </script>
@endsection
