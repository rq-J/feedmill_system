<div>
    <div class="row">
        <div class="col-6">
            <label for="myMacroSelect" class="col-form-label">Macro</label>
            <select name="" id="myMacroSelect" class="form-control">
                @foreach ($arrMacro as $macro)
                <option value="{{ $macro->raw_material_name }}">{{ $macro->raw_material_name }}</option>
                @endforeach
            </select>

            <br>

            <label for="myMicroSelect" class="col-form-label">Micro</label>
            <select name="" id="myMicroSelect" class="form-control">
                @foreach ($arrMicro as $micro)
                <option value="{{ $micro->raw_material_name }}">{{ $micro->raw_material_name }}</option>
                @endforeach
            </select>

            <br>

            <label for="myMedSelect" class="col-form-label">Medicine</label>
            <select name="" id="myMedSelect" class="form-control">
                @foreach ($arrMedicine as $medicine)
                <option value="{{ $medicine->raw_material_name }}">{{ $medicine->raw_material_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <div class="container">
                <h5>Ingredients</h5>
                <ul id="myList"></ul>
                <button id="undoButton" class="btn btn-primary" style="float:right;">Reset</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
  <script>
  $(document).ready(function() {
    // Hide the selected option from the select element
    $('#myMacroSelect').on('change', function() {
      var selectedOption = $(this).val();
      $(this).find('option[value="' + selectedOption + '"]').hide();

      // Show the selected option in the ul list
      $('<li>').text(selectedOption).appendTo('#myList');
    });

    // Hide the selected option from the select element
    $('#myMicroSelect').on('change', function() {
      var selectedOption = $(this).val();
      $(this).find('option[value="' + selectedOption + '"]').hide();

      // Show the selected option in the ul list
      $('<li>').text(selectedOption).appendTo('#myList');
    });

    // Hide the selected option from the select element
    $('#myMedSelect').on('change', function() {
      var selectedOption = $(this).val();
      $(this).find('option[value="' + selectedOption + '"]').hide();

      // Show the selected option in the ul list
      $('<li>').text(selectedOption).appendTo('#myList');
    });

    // Handle undo button click
    $('#undoButton').on('click', function() {
      if (selectedOption) {
        // Show the hidden option in the select element
        $('#myMacroSelect').find('option[value="' + selectedOption + '"]').show();
        $('#myMicroSelect').find('option[value="' + selectedOption + '"]').show();
        $('#myMedSelect').find('option[value="' + selectedOption + '"]').show();


        // Remove the corresponding li element from the ul list
        $('#myList li').filter(function() {
          return $(this).text() === selectedOption;
        }).remove();

        selectedOption = null;
      }
    });
  });
  </script>
@endsection
