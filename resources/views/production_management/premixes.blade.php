@extends('layouts.app')

@section('title')
	Premixes
@endsection

@section('content')
	<h3>Premixes</h3>
    <div class="container" id="table">
        {{-- <livewire:raw-material-table /> --}}
        {{-- TODO : insert data table here --}}
        <table id="premix_table" class="table table-bordered table-hover text-nowrap" style="width: 100%;">
            <thead>
                <tr>
                    <th class="text-center">Item Name</th>
                    <th class="text-center">Beginning</th>
                    <th class="text-center">Micro</th>
                    <th class="text-center">Macro</th>
                    <th class="text-center">Ending</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      let farms = $('#premix_table').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        columnDefs: [{  className: "dt-center", targets: [0, 1, 2, 3, 4] }],

        ajax: "{{ route('premixes') }}",
        columns: [
            { data: 'item_name', name: 'item_name'},
            { data: 'beginning', name: 'beginning'},
            { data: 'micro', name: 'micro',},
            { data: 'macro', name: 'macro'},
            { data: 'ending', name: 'ending'},
        ],
        pagingType: 'full_numbers',
        language: {
            "emptyTable": "No Premix records."
        },
        searching: true,
      });
    });

    $(document).on('click', '#refresh', function(e) {
      var farms = $('#premix_table').DataTable();
      farms.ajax.reload();
    });
  </script>
@endsection
