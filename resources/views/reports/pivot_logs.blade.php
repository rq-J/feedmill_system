@extends('layouts.app')

@section('title')
    Pivot Logs
@endsection

@section('content')
    <div class="bg-white shadow-lg rounded container">
        <h3 class="pt-4">Pivot Logs</h3>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <h4 class="col-8">Quality Assurance</h4>
                    <a href="{{ route('pivot.qa') }}" class="btn btn-primary col-4">Select</a>
                </div>
                {{-- <livewire:farm-table /> --}}
                {{-- TODO : insert data table here --}}

            </div>
            <div class="col-12">
                <div class="row">
                    <h4 class="col-8">Downtime</h4>
                    <a href="{{ route('pivot.dt') }}" class="btn btn-primary col-4">Select</a>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="container">
                <div style="padding:10px">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="audits" class="table table-bordered table-hover text-nowrap" width="100%">
                                <thead>
                                <tr>
                                    <th scope="col">Year</th>
                                    <th scope="col">Month</th>
                                    <th scope="col">Tons Produced</th>
                                    <th scope="col">Electric Cost</th>
                                    <th scope="col">Labot Cost</th>
                                    <th scope="col">Ovetime Cost</th>
                                    <th scope="col">Kilowatt Hour Per Kilos</th>
                                    <th scope="col">Man Hour Per Kilos</th>
                                    <th scope="col">Overtime Cost Per Kilos</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
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
        columnDefs: [{ className: "dt-center", targets: [0, 1, 2, 3, 4, 5, 6, 7, 8] }],

        ajax: "{{ route('pivot') }}",
        columns: [
          {data: 'year', name: 'year'},
          {data: 'month', name: 'month'},
          {data: 'total_tons', name: 'total_tons'},
          {data: 'electric_cost', name: 'electric_cost'},
          {data: 'labor', name: 'labor'},
          {data: 'overtime', name: 'overtime'},
          {data: 'kilowatt', name: 'kilowatt'},
          {data: 'man_hour', name: 'man_hour'},
          {data: 'overtime_cost', name: 'overtime_cost'},
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
