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
        {{-- #BUG: should be disabled once used, once a day only --}}
        <button class="btn btn-primary d-block" id="saveButton">Save for today</button>
    </ul>
    <div class="tab-content">
        <div id="macro" class="tab-pane fade show active" style="margin-top:6px;">
            {{-- # NOTE: right now, the table is not dynamic; in the future, the farm will request an item and the requested item will only appear here --}}
            <table id="macroTable" class="table table-hover table-bordered text-center">
                <thead>
                    {{-- <h5 class="text-center">Item</h5> --}}
                    <tr>
                        <th style="display:;">ID</th>
                        <th>Item Name</th>
                        <th>Batch</th>
                        <th>Adjustment</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($unique_item_ids as $item_id)
                    <tr>
                        <td style="display:;">{{ $item_id['item_id'] }}</td>
                        <td>{{ $item_id['item_name'] }}</td>
                        {{-- #BUG: the user can input letter , there is server-side validation though--}}
                        <td><input class="form-control" type="number" name="batch"></td>
                        <td><input class="form-control" type="number" name="adjustment"></td>
                    </tr>
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
                        <th>Batch</th>
                        <th>Adjustment</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($unique_item_ids as $item_id)
                    <tr>
                        <td style="display:;">{{ $item_id['item_id'] }}</td>
                        <td>{{ $item_id['item_name'] }}</td>
                        <td><input class="form-control" type="number" name="batch"></td>
                        <td><input class="form-control" type="number" name="adjustment"></td>
                    </tr>
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
                        <th>Batch</th>
                        <th>Adjustment</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($unique_item_ids as $item_id)
                    <tr>
                        <td style="display:;">{{ $item_id['item_id'] }}</td>
                        <td>{{ $item_id['item_name'] }}</td>
                        <td><input class="form-control" type="number" name="batch"></td>
                        <td><input class="form-control" type="number" name="adjustment"></td>
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

        // Make the date same as phpmyadmin
        var date = new Date();
        var formattedDateTime = `${date.getFullYear()}-${(date.getMonth()+1).toString().padStart(2, '0')}-${date.getDate().toString().padStart(2, '0')} ${date.getHours().toString().padStart(2, '0')}:${date.getMinutes().toString().padStart(2, '0')}:${date.getSeconds().toString().padStart(2, '0')}`;
        $('#macroTable tbody tr').each(function() {
          var rowData = {};
          rowData['ID'] = $(this).find('td:eq(0)').text();
        //   rowData['item_id'] = "asaaa";
          // rowData['raw_material_id'] = $(this).find('td:eq(0)').text();
          // var inputValue = $(this).find('input').val();
          var input1 = $(this).find('input[name="batch"]').val();
          var input2 = $(this).find('input[name="adjustment"]').val();
          rowData['created_at'] = formattedDateTime;
          rowData['updated_at'] = formattedDateTime;
          if (input1.trim() !== '') {
            rowData['batch'] = input1;
          } else {
            rowData['batch'] = 'No input';
          }
          if (input2.trim() !== '') {
            rowData['adjustment'] = input2;
          } else {
            rowData['adjustment'] = 'No input';
          }
          arrMacro.push(rowData);
        });

        $('#microTable tbody tr').each(function() {
          var rowData = {};
          rowData['ID'] = $(this).find('td:eq(0)').text();
        //   rowData['item_id'] = "asaaa";
          // rowData['raw_material_id'] = $(this).find('td:eq(0)').text();
          // var inputValue = $(this).find('input').val();
          var input1 = $(this).find('input[name="batch"]').val();
          var input2 = $(this).find('input[name="adjustment"]').val();
          rowData['created_at'] = formattedDateTime;
          rowData['updated_at'] = formattedDateTime;
          if (input1.trim() !== '') {
            rowData['batch'] = input1;
          } else {
            rowData['batch'] = 'No input';
          }
          if (input2.trim() !== '') {
            rowData['adjustment'] = input2;
          } else {
            rowData['adjustment'] = 'No input';
          }
          arrMicro.push(rowData);
        });

        $('#medicineTable tbody tr').each(function() {
          var rowData = {};
          rowData['ID'] = $(this).find('td:eq(0)').text();
        //   rowData['item_id'] = "asaaa";
          // rowData['raw_material_id'] = $(this).find('td:eq(0)').text();
          // var inputValue = $(this).find('input').val();
          var input1 = $(this).find('input[name="batch"]').val();
          var input2 = $(this).find('input[name="adjustment"]').val();
          rowData['created_at'] = formattedDateTime;
          rowData['updated_at'] = formattedDateTime;
          if (input1.trim() !== '') {
            rowData['batch'] = input1;
          } else {
            rowData['batch'] = 'No input';
          }
          if (input2.trim() !== '') {
            rowData['adjustment'] = input2;
          } else {
            rowData['adjustment'] = 'No input';
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
