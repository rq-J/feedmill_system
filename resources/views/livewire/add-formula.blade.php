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
                {{-- <label for="myMacroList" class="col-form-label">Macro</label>
                <ul id="myMacroList"></ul>
                <label for="myMicroList" class="col-form-label">Micro</label>
                <ul id="myMicroList"></ul>
                <label for="myMedicineList" class="col-form-label">Medicine</label>
                <ul id="myMedicineList"></ul> --}}

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
                <button id="addButton" class="btn btn-primary" style="float:right;">Add</button>
                <button id="undoButton" class="btn btn-danger" style="float:right;">Remove Last Item</button>

            </div>
        </div>
    </div>
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
      $('<td>').append($('<input class="form-control">').attr('type', 'number').appendTo($row)).appendTo($row);
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
      $('<td>').append($('<input class="form-control">').attr('type', 'number').appendTo($row)).appendTo($row);
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
      $('<td>').append($('<input class="form-control">').attr('type', 'number').appendTo($row)).appendTo($row);
      $row.appendTo('#myTable tbody');
    });

    // Handle undo button click
    $('#undoButton').on('click', function() {
      if (selectedOptions.length > 0) {
        var selectedOptionName = $('#myList li:last-child').text();

        // Show the hidden option in the select element
        var selectedOption = $('#myMacroSelect').find('option:contains("' + selectedOptionName + '")').val();
        $('#myMacroSelect').find('option[value="' + selectedOption + '"]').show();
        var selectedOption = $('#myMicroSelect').find('option:contains("' + selectedOptionName + '")').val();
        $('#myMicroSelect').find('option[value="' + selectedOption + '"]').show();
        var selectedOption = $('#myMedicineSelect').find('option:contains("' + selectedOptionName + '")').val();
        $('#myMedicineSelect').find('option[value="' + selectedOption + '"]').show();

        // Remove the corresponding li element from the ul list
        $('#myList li:last-child').remove();

        // Remove selected option from the array
        var index = selectedOptions.indexOf(selectedOptionName);
        if (index > -1) {
            selectedOptions.splice(index, 1);
        }

        // Remove the corresponding table row
        $('#myTable tbody tr:last-child').remove();
      }
    //   if (selectedOption) {
    //     // Show the hidden option in the select element
    //     $('#myMacroSelect').find('option[value="' + selectedOption + '"]').show();
    //     $('#myMicroSelect').find('option[value="' + selectedOption + '"]').show();
    //     $('#myMedSelect').find('option[value="' + selectedOption + '"]').show();

    //     // Remove the corresponding li element from the ul list
    //     $('#myList li').filter(function() {
    //       return $(this).text() === selectedOption;
    //     }).remove();

    //     selectedOption = null;
    //     selectedOptionName = null;
    //     selectedOptions = null;
    //   }
    });

    // Handle collect button click
    $('#addButton').on('click', function() {
    //   console.log(selectedOptions); // Array of selected option names
      // Extract text and input values from the table
      var tableData = [];
      $('#myTable tbody tr').each(function() {
        var rowData = {};
        // rowData['ID'] = $(this).find('td:eq(0)').text();
        rowData['item_id'] = "{{ $item_id }}";
        rowData['raw_material_id'] = $(this).find('td:eq(0)').text();
        var inputValue = $(this).find('input').val();
        if (inputValue.trim() !== '') {
          rowData['standard'] = inputValue;
        } else {
          rowData['standard'] = 'No input';
        }
        rowData['active_status'] = "1";
        tableData.push(rowData);
      });
      console.log(tableData);
      Livewire.emit('dataSaved', tableData);

      // Send the extracted data to Laravel endpoint using Ajax
    //   $.ajax({
    //     url: '/save-data', // Update this URL to your Laravel endpoint
    //     type: 'POST', // Update the HTTP method as needed
    //     data: {tableData: tableData}, // Pass the extracted data as JSON object
    //     success: function(response) {
    //       console.log('Data saved successfully:', response);
    //     },
    //     error: function(xhr, status, error) {
    //       console.error('Error saving data:', error);
    //     }
    //   });
    });
  });
  </script>
@endsection
