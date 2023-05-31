@extends('layouts.app')

@section('title')
	Inventory Levels
@endsection

@section('content')
    <div class="bg-white shadow-lg rounded container">
        <h3 class="pt-4">Inventory Levels</h3>
        <div>
            <table id="audits" class="table table-bordered table-hover text-nowrap" width="100%">
                <thead>
                <tr>
                    <th scope="col">Raw Material Name</th>
                    <th scope="col">Inventory Level</th>
                </tr>
                </thead>
            </table>
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
        columnDefs: [{ className: "dt-center", targets: [0, 1] }],

        ajax: "{{ route('inventory') }}",
        columns: [
          {data: 'raw_material', name: 'raw_material'},
          {data: 'inventory_level', name: 'inventory_level'},
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
