{{-- #[ ]: try to make it livewire then validate each input to number only --}}
<div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#macro">
                <h5 style="margin-bottom: 0;">Macro</h5>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#micro">
                <h5 style="margin-bottom: 0;">Micro</h5>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#medicine">
                <h5 style="margin-bottom: 0;">Medicine</h5>
            </a>
        </li>
        {{-- #FIXME: align this to left --}}
        {{-- #NOTE: should be disabled once used, once a day only --}}
        <button class="btn btn-primary d-block" id="saveButton">Save for today</button>
    </ul>
    <div class="tab-content">
        <div id="macro" class="tab-pane fade show active" style="margin-top:6px;">
            @if (session('danger_message'))
                <p>{{ session('danger_message') }}</p>
            @endif
            <div class="row">
                <label for="number_of_working_days" class="text-center d-block">
                    <h5>Number of Working Days:</h5>
                </label>
                <input class="form-control text-center" type="number" name="macro_number_of_working_days"
                    id="macro_number_of_working_days">
                <hr style="color: transparent;">
            </div>
            <table id="macroTable" class="table table-hover table-bordered text-center">
                <thead>
                    {{-- <h5 class="text-center">Item</h5> --}}
                    <tr>
                        <th style="display: none;">ID</th>
                        <th>Raw Material Name</th>
                        <th>Price per kgs</th>
                        <th>Inventory Cost</th>
                        <th>Kgs per bag</th>
                        <th>Deliveries Today</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($arrMacro as $macro)
                        <tr>
                            <td style="display: none;">{{ $macro['id'] }}</td>
                            <td>{{ $macro['raw_material_name'] }}</td>
                            <td>
                                <input class="form-control" type="number" name="price_per_kgs"
                                    value="{{ $macro['price_per_kgs'] }}">
                            </td>
                            <td>
                                <input class="form-control" type="number" name="inventory_cost"
                                    value="{{ $macro['inventory_cost'] }}">
                            </td>
                            <td>
                                <input class="form-control" type="number" name="kgs_per_bag"
                                    value="{{ $macro['kgs_per_bag'] }}">
                            </td>
                            <td>
                                <input class="form-control" type="number" name="deliveries_today">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="micro" class="tab-pane fade" style="margin-top:6px;">
            <div class="row">
                <label for="number_of_working_days" class="text-center d-block">
                    <h5>Number of Working Days:</h5>
                </label>
                <input class="form-control text-center" type="number" name="micro_number_of_working_days"
                    id="micro_number_of_working_days">
                <hr style="color: transparent;">
            </div>
            <table id="microTable" class="table table-hover table-bordered text-center">
                <thead>
                    {{-- <h5 class="text-center">Item</h5> --}}
                    <tr>
                        <th style="display: none;">ID</th>
                        <th>Raw Material Name</th>
                        <th>Price per kgs</th>
                        <th>Inventory Cost</th>
                        <th>Kgs per bag</th>
                        <th>Deliveries Today</th>
                        <th>Actual Count of Bags</th>
                        <th>Actual Count of Kgs</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($arrMicro as $micro)
                        <tr>
                            <td style="display: none;">{{ $micro['id'] }}</td>
                            <td>{{ $micro['raw_material_name'] }}</td>
                            <td>
                                <input class="form-control" type="number" name="price_per_kgs"
                                    value="{{ $micro['price_per_kgs'] }}">
                            </td>
                            <td>
                                <input class="form-control" type="number" name="inventory_cost"
                                    value="{{ $micro['inventory_cost'] }}">
                            </td>
                            <td>
                                <input class="form-control" type="number" name="kgs_per_bag"
                                    value="{{ $micro['kgs_per_bag'] }}">
                            </td>
                            <td>
                                <input class="form-control" type="number" name="deliveries_today">
                            </td>
                            <td>
                                <input class="form-control" type="number" name="actual_count_bags">
                            </td>
                            <td>
                                <input class="form-control" type="number" name="actual_count_kgs">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="medicine" class="tab-pane fade" style="margin-top:6px;">
            <div class="row">
                <label for="number_of_working_days" class="text-center d-block">
                    <h5>Number of Working Days:</h5>
                </label>
                <input class="form-control text-center" type="number" name="medicine_number_of_working_days"
                    id="medicine_number_of_working_days">
                <hr style="color: transparent;">
            </div>
            <table id="medicineTable" class="table table-hover table-bordered text-center">
                <thead>
                    {{-- <h5 class="text-center">Item</h5> --}}
                    <tr>
                        <th style="display: none;">ID</th>
                        <th>Raw Material Name</th>
                        <th>Price per kgs</th>
                        <th>Inventory Cost</th>
                        <th>Kgs per bag</th>
                        <th>Deliveries Today</th>
                        <th>Actual Count of Bags</th>
                        <th>Actual Count of Kgs</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- #[ ]: weird ui --}}
                    {{-- #[ ]: update to array formula like weekly request  --}}
                    @foreach ($arrMedicine as $medicine)
                        <tr>
                            <td style="display:none;">{{ $medicine['id'] }}</td>
                            <td>{{ $medicine['raw_material_name'] }}</td>
                            <td>
                                <input class="form-control" type="number" name="price_per_kgs"
                                    value="{{ $medicine['price_per_kgs'] }}">
                            </td>
                            <td>
                                <input class="form-control" type="number" name="inventory_cost"
                                    value="{{ $medicine['inventory_cost'] }}">
                            </td>
                            <td>
                                <input class="form-control" type="number" name="kgs_per_bag"
                                    value="{{ $medicine['kgs_per_bag'] }}">
                            </td>
                            <td>
                                <input class="form-control" type="number" name="deliveries_today">
                            </td>
                            <td>
                                <input class="form-control" type="number" name="actual_count_bags">
                            </td>
                            <td>
                                <input class="form-control" type="number" name="actual_count_kgs">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
    <script>

        $(document).ready(function() {

            //[x]: get all the input(like formula.blade.php) then pass it onto the controller via .emit
            $('#saveButton').on('click', function() {
                //   console.log(selectedOptions); // Array of selected option names
                // Extract text and input values from the table
                var arrMacro = [];
                var arrMicro = [];
                var arrMedicine = [];
                var macro_days = $('#macro_number_of_working_days').val();

                $('#macroTable tbody tr').each(function() {
                    var rowData = {};
                    rowData['id'] = $(this).find('td:eq(0)').text();
                    var price_per_kgs = $(this).find('input[name="price_per_kgs"]').val();
                    var inventory_cost = $(this).find('input[name="inventory_cost"]').val();
                    var kgs_per_bag = $(this).find('input[name="kgs_per_bag"]').val();
                    var deliveries_today = $(this).find('input[name="deliveries_today"]').val();

                    rowData['number_of_working_days'] = processInput(macro_days);
                    rowData['price_per_kgs'] = processInput(price_per_kgs);
                    rowData['inventory_cost'] = processInput(inventory_cost);
                    rowData['kgs_per_bag'] = processInput(kgs_per_bag);
                    rowData['deliveries_today'] = processInput(deliveries_today);

                    arrMacro.push(rowData);
                });

                $('#microTable tbody tr').each(function() {
                    var rowData = {};
                    rowData['id'] = $(this).find('td:eq(0)').text();
                    var price_per_kgs = $(this).find('input[name="price_per_kgs"]').val();
                    var inventory_cost = $(this).find('input[name="inventory_cost"]').val();
                    var kgs_per_bag = $(this).find('input[name="kgs_per_bag"]').val();
                    var deliveries_today = $(this).find('input[name="deliveries_today"]').val();
                    var actual_count_bags = $(this).find('input[name="actual_count_bags"]').val();
                    var actual_count_kgs = $(this).find('input[name="actual_count_kgs"]').val();

                    rowData['number_of_working_days'] = processInput(macro_days);
                    rowData['price_per_kgs'] = processInput(price_per_kgs);
                    rowData['inventory_cost'] = processInput(inventory_cost);
                    rowData['kgs_per_bag'] = processInput(kgs_per_bag);
                    rowData['deliveries_today'] = processInput(deliveries_today);
                    rowData['actual_count_bags'] = processInput(actual_count_bags);
                    rowData['actual_count_kgs'] = processInput(actual_count_kgs);

                    arrMicro.push(rowData);
                });

                $('#medicineTable tbody tr').each(function() {
                    var rowData = {};
                    rowData['id'] = $(this).find('td:eq(0)').text();
                    var price_per_kgs = $(this).find('input[name="price_per_kgs"]').val();
                    var inventory_cost = $(this).find('input[name="inventory_cost"]').val();
                    var kgs_per_bag = $(this).find('input[name="kgs_per_bag"]').val();
                    var deliveries_today = $(this).find('input[name="deliveries_today"]').val();
                    var actual_count_bags = $(this).find('input[name="actual_count_bags"]').val();
                    var actual_count_kgs = $(this).find('input[name="actual_count_kgs"]').val();

                    rowData['number_of_working_days'] = processInput(macro_days);
                    rowData['price_per_kgs'] = processInput(price_per_kgs);
                    rowData['inventory_cost'] = processInput(inventory_cost);
                    rowData['kgs_per_bag'] = processInput(kgs_per_bag);
                    rowData['deliveries_today'] = processInput(deliveries_today);
                    rowData['actual_count_bags'] = processInput(actual_count_bags);
                    rowData['actual_count_kgs'] = processInput(actual_count_kgs);

                    arrMedicine.push(rowData);
                });

                // console.log(arrMacro, arrMicro, arrMedicine);
                Livewire.emit('saveData', [
                    arrMacro,
                    arrMicro,
                    arrMedicine,
                ]);
            });

            function processInput(input) {
                if (input.trim() !== '') {
                    return input;
                } else {
                    return '0';
                }
            }
        });
    </script>
@endsection
