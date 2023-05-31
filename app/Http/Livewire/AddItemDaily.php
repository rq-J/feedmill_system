<?php

namespace App\Http\Livewire;

use App\Models\ItemDaily;
use App\Models\ItemFormula;
use Livewire\Component;
use App\Http\Controllers\AuditController as AC;
use App\Models\Item;
use App\Models\Premix;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class AddItemDaily extends Component
{
    public $arrMacro = [];
    public $arrMicro = [];
    public $arrMedicine = [];

    public $unique_item_ids = [];
    public $unique_farm_ids = [];
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
        $this->arrMacro = ItemFormula::select('items.item_name', 'farms.farm_name', 'raw_materials.category', 'item_formulas.*')
            ->where('item_formulas.active_status', 1)
            ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
            ->join('items', 'item_formulas.item_id', '=', 'items.id')
            ->join('farms', 'items.farm_id', '=', 'farms.id')
            ->where('raw_materials.category', '=', 'MACRO')
            ->get();
        // dd($this->arrMacro);
        $this->arrMicro = ItemFormula::select('items.item_name', 'farms.farm_name', 'raw_materials.category', 'item_formulas.*')
            ->where('item_formulas.active_status', 1)
            ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
            ->join('items', 'item_formulas.item_id', '=', 'items.id')
            ->join('farms', 'items.farm_id', '=', 'farms.id')
            ->where('raw_materials.category', '=', 'MICRO')
            ->get();
        $this->arrMedicine = ItemFormula::select('items.item_name', 'farms.farm_name', 'raw_materials.category', 'item_formulas.*')
            ->where('item_formulas.active_status', 1)
            ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
            ->join('items', 'item_formulas.item_id', '=', 'items.id')
            ->join('farms', 'items.farm_id', '=', 'farms.id')
            ->where('raw_materials.category', '=', 'MEDICINE')
            ->get();

        $this->unique_item_ids = ItemFormula::where('item_formulas.active_status', 1)
            ->join('items', 'item_formulas.item_id', '=', 'items.id')
            ->select('item_formulas.item_id', 'items.item_name') //Get id
            ->distinct() //Get unique id
            ->get();

        $this->unique_farm_ids = ItemFormula::where('item_formulas.active_status', 1)
            ->join('items', 'item_formulas.item_id', '=', 'items.id')
            ->join('farms', 'items.farm_id', '=', 'farms.id')
            ->select('items.farm_id', 'farms.farm_name') //Get id
            ->distinct() //Get unique farm id
            ->get();
        // dd($this->unique_farm_ids);
    }

    function hasUniqueItems($arrMacro, $unique_item_ids)
    {
        // dd($arrMacro, $unique_item_ids);
        $comparison = collect([]);
        foreach ($arrMacro as $macro) {
            foreach ($unique_item_ids as $unique_id) {
                if ($macro->item_id == $unique_id->item_id) {
                    $comparison->push($macro->item_id, $unique_id->item_id);
                    info($comparison);
                    return true;
                }
            }
        }
        return false;
    }

    public function create($input)
    {
        // Item Dailies
        $macro_input = $input[0];
        $micro_input = $input[1];
        $medicine_input = $input[2];
        // $this->arrMacro = ItemFormula::select('raw_materials.*', 'item_formulas.*')
        //     ->where('item_formulas.active_status', 1)
        //     ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
        //     ->where('raw_materials.category', '=', 'MACRO')
        //     ->get();
        // $this->arrMicro = ItemFormula::select('raw_materials.*', 'item_formulas.*')
        //     ->where('item_formulas.active_status', 1)
        //     ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
        //     ->where('raw_materials.category', '=', 'MICRO')
        //     ->get();
        // $this->arrMedicine = ItemFormula::select('raw_materials.*', 'item_formulas.*')
        //     ->where('item_formulas.active_status', 1)
        //     ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
        //     ->where('raw_materials.category', '=', 'MEDICINE')
        //     ->get();

        // dd($this->arrMacro);

        // dd($macro_input);
        // dd($this->validateArray($data));
        // dd($this->mergeArray($this->arrMacro, $data));
        if ($this->validateArray($macro_input) || $this->validateArray($micro_input) || $this->validateArray($medicine_input)) {
            try {
                $this->pushToDatabase($this->mergeArray($this->arrMacro, $macro_input));
                $this->pushToDatabase($this->mergeArray($this->arrMicro, $micro_input));
                $this->pushToDatabase($this->mergeArray($this->arrMedicine, $medicine_input));

                // Premix
                $yesterday = Carbon::yesterday();
                $unique_micro_items = ItemFormula::where('item_formulas.active_status', 1)
                    ->join('items', 'item_formulas.item_id', '=', 'items.id')
                    ->where('items.active_status', 1)
                    ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
                    ->where('category', 'MICRO')
                    ->select('item_formulas.item_id', 'items.item_name') //Get id
                    ->distinct() //Get unique id
                    ->get();
                $items = Item::where('active_status', 1)->get();

                // Extract the unique item_id values from $unique_micro_items using the pluck method
                $unique_micro_item_ids = $unique_micro_items->pluck('item_id')->toArray();
                // Use the whereIn method on $items to filter the collection based on the extracted item_id values
                $micro_items = $items->whereIn('id', $unique_micro_item_ids);

                $beginning = Premix::select('item_name', 'farm_name', 'premixes.*')
                    ->whereDate('premixes.created_at', $yesterday)
                    ->join('items', 'premixes.item_id', '=', 'items.id')
                    ->join('farms', 'items.farm_id', '=', 'farms.id')
                    ->get();

                // dd($beginning);

                $premix = collect([]);

                foreach ($micro_items as $item_key => $item) {
                    // Simplify code for setting $newBeginning
                    // [x]: beginning, to be fixed
                    if ($beginning->count() == 0) {
                        $newBeginning = '0';
                    } else {
                        $newBeginning = $beginning[0]['ending'];
                    }
                    // dd($newBeginning);
                    $macro_id = array_search($item['id'], array_column($macro_input, 'id'));
                    // Log::info($item['id']);
                    if ($macro_id !== false) {
                        $id = $item['id']; // Use $item instead of $items
                        $macro = null; // Initialize $macro and $micro to null
                        $micro = null;

                        // Use foreach to find matching $macro_item by id
                        foreach ($macro_input as $macro_item) {
                            if ($macro_item['id'] == $id) {
                                $macro = $macro_item['batch'];
                                break; // Exit loop once matching $macro_item is found
                            }
                        }

                        // Use foreach to find matching $micro_item by id
                        foreach ($micro_input as $micro_item) {
                            if ($micro_item['id'] == $id) {
                                $micro = $micro_item['batch'];
                                break; // Exit loop once matching $micro_item is found
                            }
                        }
                        $ending = $this->compute_ending($newBeginning, $micro, $macro);

                        $premix->push([
                            'item_id' => $id,
                            'beginning' => $newBeginning,
                            'micro' => $micro,
                            'macro' => $macro,
                            'ending' => $ending,
                            'created_at' => now()
                        ]);
                        // dd($premix->toArray());
                        // [x]: ?? no save in db?????
                        Premix::insert($premix->toArray());
                        // Loop through each item_daily
                        foreach ($premix as $mix) {
                            // Log the changes
                            $log_entry = [
                                'add',
                                'premix',
                                '',
                                json_encode($mix),

                            ];
                            AC::logEntry($log_entry);
                        }
                    }
                }

                return redirect('/item_daily')
                    ->with(
                        'success_message',
                        // strtoupper($this->tableData) . ' has been Successfully Created!'
                        'Item Daily has been Successfully Created!'
                    );
            } catch (Exception $exception) {
                // return redirect('/item_daily')
                //     ->with(
                //         'danger_message',
                //         // strtoupper($this->tableData) . ' has been Successfully Created!'
                //         'Unable to store the data!'
                //     );
            }
        }


        // dd($premix);
    }

    public function compute_ending($beginning, $micro, $macro)
    {
        $ending = $beginning + $micro - $macro;
        return $ending;
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

    //[x]: function, forloop the array to push every category-by-item and add the batch, total batch, adjustment and ending to the array
    public function mergeArray($macroArray, array $inputArray)
    {
        // Initialize empty array to hold results
        $results = array();

        // dd($macroArray);

        // Loop through the first array
        foreach ($macroArray as $macro) {

            // Initialize variables to hold category and macro id
            $item_id = $macro['item_id'];

            // Initialize variables to hold item_formula_id, batch, total batch, and adjustment
            $item_formula_id = "";
            $batch = 0;
            $total_batch = 0;
            $adjustment = 0;

            // Loop through the second array
            foreach ($inputArray as $input) {

                // If the item id matches the current item id from the first array
                if ($input['id'] == $item_id) {
                    // dd($item_id);
                    $yesterday = Carbon::yesterday();

                    $batch_yesterday_query = ItemDaily::select('item_dailies.*')
                        ->whereDate('item_dailies.created_at', $yesterday)
                        ->where('item_formula_id', $item_id)
                        ->get();
                    // dd($batch_yesterday_query[0]['total_batch']);

                    $item_formula_id = $macro['id'];

                    $batch += $input['batch'];

                    // Add the batch to the total batch
                    // [x]: batch yesterday should be included
                    // maybe find yesterday's record using "whereDate = yesterday"
                    $total_batch = intval($input['batch']) + intval($batch_yesterday_query->count() > 0 ? $batch_yesterday_query[0]['total_batch'] : 0); // +yesterday total batch
                    // dd('error');

                    // Add the adjustment to the adjustment variable
                    $adjustment += $input['adjustment'];

                    // Calculate the usage based on the standard and the batch
                    $usage = $macro['standard'] * $input['batch'] + $input['adjustment'];
                }
            }

            // Push the category-by-item with batch, total batch, adjustment, and usage to the results array
            array_push($results, array(
                'item_formula_id' => $item_formula_id,
                'batch' => $batch,
                'total_batch' => $total_batch,
                'adjustment' => $adjustment,
                'usage' => $usage,
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
        $data = array_map(function ($item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
            return $item;
        }, $data);
        // dd($data, $this->arrMacro);
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
