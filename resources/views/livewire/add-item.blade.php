<div class="container">
    {{-- <form method="POST"> --}}
    @csrf
    @php
        $upCaseField = 'style="text-transform:uppercase;"';
    @endphp
    <div class="row mb-3">
        <label for="item_name" class="col-md-3 col-form-label text-md">{{ __('Item') }}<span
                class="text-danger">*</span></label>

        <div class="col-md-12">
            <input id="item_name" type="text" wire:model="item_name" wire:keyup="valOnly"
                class="form-control @error('item_name') is-invalid @enderror" name="item_name"
                value="{{ old('item_name') }}" placeholder="e.g: ITEM" autocomplete="item_name" autofocus
                {!! $upCaseField !!}>

            @error('item_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            {{ strtoupper($item_name) }}
        </div>
    </div>

    <div class="row mb-3">
        <label for="selectedFarm" class="col-md-2 col-form-label text-md">{{ __('Farm') }}</label>

        <div class="col-md-12">
            <select wire:model="selectedFarm" class="form-control">
                @foreach ($farms as $key => $value)
                    <option value="{{ $value->id }}">{{ ucfirst($value->farm_name) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- {{ strtoupper($selectedFarm) }} --}}

    <div class="row">
        <div class="col-md-12">

            <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Create New Raw Material?</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are You Sure You Want To Create New Raw Material?
                        </div>
                        <div class="modal-footer">
                            <button data-bs-dismiss="modal" aria-label="Close"
                                class="btn btn-secondary">{{ __('No') }}</button>
                            <button id="addButton" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ __('Yes') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="row">
            <div class="col-4">
                <label for="myMacroSelect" class="col-form-label">Macro</label>
                <select name="" id="myMacroSelect" class="form-control">
                    @foreach ($arrMacro as $macro)
                        <option value="{{ $macro->id }}">{{ $macro->raw_material_name }}</option>
                    @endforeach
                </select>

                <br>

                <label for="myMicroSelect" class="col-form-label">Micro</label>
                <select name="" id="myMicroSelect" class="form-control">
                    @foreach ($arrMicro as $micro)
                        <option value="{{ $micro->id }}">{{ $micro->raw_material_name }}</option>
                    @endforeach
                </select>

                <br>

                <label for="myMedicineSelect" class="col-form-label">Medicine</label>
                <select name="" id="myMedicineSelect" class="form-control">
                    @foreach ($arrMedicine as $medicine)
                        <option value="{{ $medicine->id }}">{{ $medicine->raw_material_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-8">
                <div class="container">
                    <h5>Ingredients</h5>
                    <table id="myTable" class="table table-hover table-bordered text-center">
                        <thead>
                            <tr>
                                <th style="display:;">ID</th>
                                <th>Raw Material Name</th>
                                <th>Standard</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#createModal">
                        Create
                    </button>
                    <button id="undoButton" class="btn btn-danger" style="float:right;">Remove Last Item</button>
                </div>
            </div>
        </div>
    </div>
    {{-- </form> --}}
</div>



@section('scripts')
    <script>
        $(document).ready(function() {

            $('#myMacroSelect').val('');
            $('#myMicroSelect').val('');
            $('#myMedicineSelect').val('');
            var selectedOptions = []; // Array to store selected options

            // Hide the selected option from the select element
            $('#myMacroSelect').on('change', function() {
                var selectedOption = $(this).val();
                var selectedOptionName = $(this).find('option[value="' + selectedOption + '"]').text();
                $(this).find('option[value="' + selectedOption + '"]').hide();

                // Show the selected option in the ul list
                $('<li>').text(selectedOptionName).appendTo('#myMacroList');

                // Add selected option to the array
                selectedOptions.push(selectedOption);

                // Add selected option to the table with input textbox
                var $row = $('<tr>');
                $('<td style="display:;">').text(selectedOption).appendTo($row);
                $('<td>').text(selectedOptionName).appendTo($row);
                $('<td>').append($('<input class="form-control">').attr('type', 'number').appendTo($row))
                    .appendTo($row);
                $row.appendTo('#myTable tbody');
            });

            // Hide the selected option from the select element
            $('#myMicroSelect').on('change', function() {
                var selectedOption = $(this).val();
                var selectedOptionName = $(this).find('option[value="' + selectedOption + '"]').text();
                $(this).find('option[value="' + selectedOption + '"]').hide();

                // Show the selected option in the ul list
                $('<li>').text(selectedOptionName).appendTo('#myMicroList');

                // Add selected option to the array
                selectedOptions.push(selectedOption);

                // Add selected option to the table with input textbox
                var $row = $('<tr>');
                $('<td style="display:;">').text(selectedOption).appendTo($row);
                $('<td>').text(selectedOptionName).appendTo($row);
                $('<td>').append($('<input class="form-control">').attr('type', 'number').appendTo($row))
                    .appendTo($row);
                $row.appendTo('#myTable tbody');
            });

            // Hide the selected option from the select element
            $('#myMedicineSelect').on('change', function() {
                var selectedOption = $(this).val();
                var selectedOptionName = $(this).find('option[value="' + selectedOption + '"]').text();
                $(this).find('option[value="' + selectedOption + '"]').hide();

                // Show the selected option in the ul list
                $('<li>').text(selectedOptionName).appendTo('#myMedicineList');

                // Add selected option to the array
                selectedOptions.push(selectedOption);

                // Add selected option to the table with input textbox
                var $row = $('<tr>');
                $('<td style="display:;">').text(selectedOption).appendTo($row);
                $('<td>').text(selectedOptionName).appendTo($row);
                $('<td>').append($('<input class="form-control">').attr('type', 'number').appendTo($row))
                    .appendTo($row);
                $row.appendTo('#myTable tbody');
            });

            // Handle undo button click
            #BUG: the remove button only removes and shows the first item in the selection
            $('#undoButton').on('click', function() {
                if (selectedOptions.length > 0) {
                    var selectedOptionName = $('#myList li:last-child').text();

                    // Show the hidden option in the select element
                    var selectedOption = $('#myMacroSelect').find('option:contains("' + selectedOptionName +
                        '")').val();
                    $('#myMacroSelect').find('option[value="' + selectedOption + '"]').show();
                    var selectedOption = $('#myMicroSelect').find('option:contains("' + selectedOptionName +
                        '")').val();
                    $('#myMicroSelect').find('option[value="' + selectedOption + '"]').show();
                    var selectedOption = $('#myMedicineSelect').find('option:contains("' +
                        selectedOptionName + '")').val();
                    $('#myMedicineSelect').find('option[value="' + selectedOption + '"]').show();

                    // Remove the corresponding li element from the ul list
                    // $('#myList li:last-child').remove();

                    // Remove selected option from the array
                    var index = selectedOptions.indexOf(selectedOptionName);
                    if (index > -1) {
                        selectedOptions.splice(index, 1);
                    }

                    // Remove the corresponding table row
                    $('#myTable tbody tr:last-child').remove();
                }
            });

            // Handle collect button click
            $('#addButton').on('click', function() {

                // Make the date same as phpmyadmin
                var date = new Date();
                var formattedDateTime =
                    `${date.getFullYear()}-${(date.getMonth()+1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')} ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}:${date.getSeconds().toString().padStart(2, '0')}`;
                // Extract text and input values from the table
                var tableData = [];
                $('#myTable tbody tr').each(function() {
                    var rowData = {};
                    // rowData['ID'] = $(this).find('td:eq(0)').text();
                    rowData['item_id'] = "1"
                    rowData['raw_material_id'] = $(this).find('td:eq(0)').text();
                    var inputValue = $(this).find('input').val();
                    if (inputValue.trim() !== '') {
                        rowData['standard'] = inputValue;
                    } else {
                        rowData['standard'] = '0';
                    }
                    rowData['active_status'] = "1";
                    tableData.push(rowData);
                });
                console.log(tableData);
                Livewire.emit('dataSaved', tableData);
            });
        });
    </script>
    <script>
        Livewire.on('categoryFarm', (option) => {
            console.log('Selected option:', option);
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
                title: 'Danger!',
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
