<div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#macro">Macro</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#micro">Micro</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#medicine">Medicine</a>
        </li>
    </ul>
    <div class="tab-content">
        <div id="macro" class="tab-pane fade show active">
            <h4>Macro</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
        <div id="micro" class="tab-pane fade">
            <h4>Micro</h4>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat.</p>
        </div>
        <div id="medicine" class="tab-pane fade">
            <h4>Medicine</h4>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            </p>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        //FOR EACH EVERY ITEM_IDS and GET THE DETAILS OF RAW MATERIAL NAME, STANDARD
        var $row = $('<tr>');
        $('<td style="display:;">').text(selectedOption).appendTo($row);
        $('<td>').text(selectedOptionName).appendTo($row);
        $('<td>').append($('<input class="form-control">').attr('type', 'number').appendTo($row)).appendTo(
        $row);
        $row.appendTo('#myTable tbody');

    });
</script>
