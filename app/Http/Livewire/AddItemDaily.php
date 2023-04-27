<?php

namespace App\Http\Livewire;

use App\Models\ItemDaily;
use App\Models\ItemFormula;
use Livewire\Component;
use App\Http\Controllers\AuditController as AC;
use Exception;

class AddItemDaily extends Component
{
    public $arrMacro = [];
    public $arrMicro = [];
    public $arrMedicine = [];

    public $unique_item_ids = [];
    public $item_ids = [];

    protected $listeners = ['saveData' => 'create'];

    public $tableData = [];

    public function render()
    {
        // dd($this->arrMacro);
        return view('livewire.add-item-daily');
    }

    public function mount()
    {
        $this->arrMacro = ItemFormula::select('raw_materials.*', 'item_formulas.*')
            ->where('item_formulas.active_status', 1)
            ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
            ->where('raw_materials.category', '=', 'MACRO')
            ->get();
        $this->arrMicro = ItemFormula::where('item_formulas.active_status', 1)
            ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
            ->where('raw_materials.category', '=', 'MICRO')
            ->get();
        $this->arrMedicine = ItemFormula::where('item_formulas.active_status', 1)
            ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
            ->where('raw_materials.category', '=', 'MEDICINE')
            ->get();

        $this->unique_item_ids = ItemFormula::where('item_formulas.active_status', 1)
            ->join('items', 'item_formulas.item_id', '=', 'items.id')
            ->select('item_formulas.item_id', 'items.item_name') //Get id
            ->distinct() //Get unique id
            ->get();
    }

    public function create($input)
    {
        $macro_input = $input[0];
        $micro_input = $input[1];
        $medicine_input = $input[2];
        $this->arrMacro = ItemFormula::select('raw_materials.*', 'item_formulas.*')
            ->where('item_formulas.active_status', 1)
            ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
            ->where('raw_materials.category', '=', 'MACRO')
            ->get();
        $this->arrMicro = ItemFormula::select('raw_materials.*', 'item_formulas.*')
            ->where('item_formulas.active_status', 1)
            ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
            ->where('raw_materials.category', '=', 'MICRO')
            ->get();
        $this->arrMedicine = ItemFormula::select('raw_materials.*', 'item_formulas.*')
            ->where('item_formulas.active_status', 1)
            ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
            ->where('raw_materials.category', '=', 'MEDICINE')
            ->get();
        // dd($macro_input);
        // dd($this->validateArray($data));
        // dd($this->mergeArray($this->arrMacro, $data));
        if ($this->validateArray($macro_input) || $this->validateArray($micro_input) || $this->validateArray($medicine_input)) {
            try {
                $this->pushToDatabase($this->mergeArray($this->arrMacro, $macro_input));
                $this->pushToDatabase($this->mergeArray($this->arrMicro, $micro_input));
                $this->pushToDatabase($this->mergeArray($this->arrMedicine, $medicine_input));

                return redirect('/item_daily')
                    ->with(
                        'success_message',
                        // strtoupper($this->tableData) . ' has been Successfully Created!'
                        'Item Daily has been Successfully Created!'
                    );
            } catch (Exception $exception) {
                return redirect('/item_daily')
                    ->with(
                        'danger_message',
                        // strtoupper($this->tableData) . ' has been Successfully Created!'
                        'Unable to store the data!'
                    );
            }
        }
    }

    //[x]: function, check the array for validations("", "letters", "scripts")
    public function validateArray(array $data)
    {
        $valid = true;
        foreach ($data as $row) {
            foreach ($data as $row) {
                if (!is_numeric($row['batch']) || !is_numeric($row['adjustment'])) {
                    $valid = false;
                    break 2;
                }
            }
        }
        return $valid;
    }

    //[x]: function, forloop the array to push every category-by-item and add the batch, total batch, adjustment and usage to the array
    public function mergeArray($macroArray, array $inputArray)
    {
        // Initialize empty array to hold results
        $results = array();

        // dd($macroArray);

        // Loop through the first array
        foreach ($macroArray as $macro) {

            // Initialize variables to hold category and macro id
            $category = $macro['category'];
            $item_id = $macro['item_id'];

            // Initialize variables to hold item_formula_id, batch, total batch, and adjustment
            $item_formula_id = "";
            $batch = 0;
            $total_batch = 0;
            $adjustment = 0;

            // Loop through the second array
            foreach ($inputArray as $input) {

                // If the item id matches the current item id from the first array
                if ($input['ID'] == $item_id) {

                    $item_formula_id = $macro['id'];

                    // Add the batch to the total batch
                    $total_batch += $input['batch'];

                    // Add the adjustment to the adjustment variable
                    $adjustment += $input['adjustment'];

                    // Calculate the usage based on the standard and the batch
                    $usage = $macro['standard'] * $input['batch'];

                    // Add the usage to the batch variable
                    $batch += $usage;
                }
            }

            // Push the category-by-item with batch, total batch, adjustment, and usage to the results array
            array_push($results, array(
                'item_formula_id' => $item_formula_id,
                // 'item_id' => $item_id,
                // 'category' => $category,
                'batch' => $batch,
                'total_batch' => $total_batch,
                'adjustment' => $adjustment,
                'usage' => $batch + $adjustment,
            ));
        }

        // Return the results array
        return $results;
        // print_r($results);
        // dd($results);

    }


    //[x]: function, push the array to database
    public function pushToDatabase(array $data)
    {
        $this->tableData = $data;
        ItemDaily::insert($data);

        // Loop through each item_daily
        foreach ($this->tableData as &$item_daily) {
            // Update active_status to 0
            $item_daily['active_status'] = 1;

            // Log the changes
            $log_entry = [
                'add item_daily',
                'item_daily',
                '',
                json_encode($item_daily),

            ];
            AC::logEntry($log_entry);
        }
    }
}
