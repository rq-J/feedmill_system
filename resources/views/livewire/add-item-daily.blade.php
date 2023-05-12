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
        {{-- #[x]: should be disabled once used, once a day only --}}
        <button class="btn btn-primary d-block" id="saveButton">Save for today</button>
    </ul>
    <div class="tab-content">
        <div id="macro" class="tab-pane fade show active" style="margin-top:6px;">
            @if (session('danger_message'))
                <p>{{ session('danger_message') }}</p>
            @endif
            <table id="macroTable" class="table table-hover table-bordered text-center">
                <thead>
                    {{-- <h5 class="text-center">Item</h5> --}}
                    <tr>
                        <th style="display:;">ID</th>
                        <th>Item Name</th>
                        <th>Farm Name</th>
                        <th>Batch</th>
                        <th>Adjustment</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($arrMacro as $macro)
                @foreach ($unique_item_ids as $unique_id)
                    @if ($macro->item_id == $unique_id->item_id)
                    <tr>
                        <td style="display:;">{{ $macro['item_id'] }}</td>
                        <td>{{ $macro['item_name'] }}</td>
                        <td> {{ $macro['farm_name'] }}</td>
                        {{-- #BUG: the user can input letter, there is server-side validation though --}}
                        <td><input class="form-control" type="number" name="batch"></td>
                        <td><input class="form-control" type="number" name="adjustment"></td>
                    </tr>
                    @endif
                @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
        <div id="micro" class="tab-pane fade" style="margin-top:6px;">
            <table id="microTable" class="table table-hover table-bordered text-center">
                <thead>
                    {{-- <h5 class="text-center">Item</h5> --}}
                    <tr>
                        <th style="display:;">ID</th>
                        <th>Item Name</th>
                        <th>Farm Name</th>
                        <th>Batch</th>
                        <th>Adjustment</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($arrMicro as $micro)
                @foreach ($unique_item_ids as $unique_id)
                    @if ($micro->item_id == $unique_id->item_id)
                    <tr>
                        <td style="display:;">{{ $micro['item_id'] }}</td>
                        <td>{{ $micro['item_name'] }}</td>
                        <td> {{ $micro['farm_name'] }}</td>
                        <td><input class="form-control" type="number" name="batch"></td>
                        <td><input class="form-control" type="number" name="adjustment"></td>
                    </tr>
                    @endif
                @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
        <div id="medicine" class="tab-pane fade" style="margin-top:6px;">
            <table id="medicineTable" class="table table-hover table-bordered text-center">
                <thead>
                    {{-- <h5 class="text-center">Item</h5> --}}
                    <tr>
                        <th style="display:;">ID</th>
                        <th>Item Name</th>
                        <th>Farm Name</th>
                        <th>Batch</th>
                        <th>Adjustment</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($arrMedicine as $medicine)
                @foreach ($unique_item_ids as $unique_id)
                    @if ($medicine->item_id == $unique_id->item_id)
                    <tr>
                        <td style="display:;">{{ $medicine['item_id'] }}</td>
                        <td>{{ $medicine['item_name'] }}</td>
                        <td> {{ $medicine['farm_name'] }}</td>
                        <td><input class="form-control" type="number" name="batch"></td>
                        <td><input class="form-control" type="number" name="adjustment"></td>
                    </tr>
                    @endif
                @endforeach
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

        // Make the date same as phpmyadmin
        var date = new Date();
        var formattedDateTime = `${date.getFullYear()}-${(date.getMonth()+1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')} ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}:${date.getSeconds().toString().padStart(2, '0')}`;
        $('#macroTable tbody tr').each(function() {
          var rowData = {};
          rowData['id'] = $(this).find('td:eq(0)').text();
        //   rowData['item_id'] = "asaaa";
          // rowData['raw_material_id'] = $(this).find('td:eq(0)').text();
          // var inputValue = $(this).find('input').val();
          var input1 = $(this).find('input[name="batch"]').val();
          var input2 = $(this).find('input[name="adjustment"]').val();
        //   rowData['created_at'] = formattedDateTime;
        //   rowData['updated_at'] = formattedDateTime;
          if (input1.trim() !== '') {
            rowData['batch'] = input1;
          } else {
            rowData['batch'] = '0';
          }
          if (input2.trim() !== '') {
            rowData['adjustment'] = input2;
          } else {
            rowData['adjustment'] = '0';
          }
          arrMacro.push(rowData);
        });

        $('#microTable tbody tr').each(function() {
          var rowData = {};
          rowData['id'] = $(this).find('td:eq(0)').text();
        //   rowData['item_id'] = "asaaa";
          // rowData['raw_material_id'] = $(this).find('td:eq(0)').text();
          // var inputValue = $(this).find('input').val();
          var input1 = $(this).find('input[name="batch"]').val();
          var input2 = $(this).find('input[name="adjustment"]').val();
        //   rowData['created_at'] = formattedDateTime;
        //   rowData['updated_at'] = formattedDateTime;
          if (input1.trim() !== '') {
            rowData['batch'] = input1;
          } else {
            rowData['batch'] = '0';
          }
          if (input2.trim() !== '') {
            rowData['adjustment'] = input2;
          } else {
            rowData['adjustment'] = '0';
          }
          arrMicro.push(rowData);
        });

        $('#medicineTable tbody tr').each(function() {
          var rowData = {};
          rowData['id'] = $(this).find('td:eq(0)').text();
        //   rowData['item_id'] = "asaaa";
          // rowData['raw_material_id'] = $(this).find('td:eq(0)').text();
          // var inputValue = $(this).find('input').val();
          var input1 = $(this).find('input[name="batch"]').val();
          var input2 = $(this).find('input[name="adjustment"]').val();
        //   rowData['created_at'] = formattedDateTime;
        //   rowData['updated_at'] = formattedDateTime;
          if (input1.trim() !== '') {
            rowData['batch'] = input1;
          } else {
            rowData['batch'] = '0';
          }
          if (input2.trim() !== '') {
            rowData['adjustment'] = input2;
          } else {
            rowData['adjustment'] = '0';
          }
          arrMedicine.push(rowData);
        });

        // console.log(arrMacro, arrMicro, arrMedicine);
        Livewire.emit('saveData', [
            arrMacro,
            arrMicro,
            arrMedicine,
        ]);
      });
    });


  </script>
@endsection
