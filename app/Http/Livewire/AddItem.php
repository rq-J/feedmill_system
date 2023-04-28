<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Farm;
use App\Models\RawMaterial;
use App\Models\ItemFormula;
use App\Http\Controllers\AuditController as AC;

class AddItem extends Component
{
    public $item_name;
    public $farms;
    public $selectedFarm;

    public $items;
    public $item_id;

    public $arrMacro = [];
    public $arrMicro = [];
    public $arrMedicine = [];

    public $tableData = [];

    protected $listeners = ['dataSaved' => 'saveData'];

    /**
     * To Render Component To The Views.
     * @param no parameter
     * @return All Values And Render It To The View
     */
    public function render()
    {
        return view('livewire.add-item');
    }

    public function mount()
    {
        $this->farms = Farm::where('active_status', 1)->get();

        $this->arrMacro =  RawMaterial::where('active_status', 1)->where('category', 'MACRO')->select('id', 'raw_material_name')->get();
        $this->arrMicro =  RawMaterial::where('active_status', 1)->where('category', 'MICRO')->select('id', 'raw_material_name')->get();
        $this->arrMedicine =  RawMaterial::where('active_status', 1)->where('category', 'MEDICINE')->select('id', 'raw_material_name')->get();
    }


    /**
     * When Called It Will Create A Real-Time Validation.
     * @param no parameter
     * @return item_name = null
     * @return standard_days = null
     * @return selectedFarm = null
     */
    public function valOnly()
    {
        $this->validate();
    }


    /**
     * Insert Rules For Validation.
     * @param no parameter
     * @return validated Data
     */
    protected $rules = [
        'item_name' => 'required|string|min:5|max:64|unique:items,item_name',
    ];

    /**
     * To return selected catergory
     * @param category
     * @return selectedCatergory
     */
    public function categorySelected($category)
    {
        return $this->selectedFarm = $category;
    }


    /**
     * To Test and Compare The Similarities of 2 Strings.
     * @param $test_val
     * @return true or false
     */
    public function test_similarity($test_val)
    {
        $gat_all_farm = item::where('active_status', 1)->pluck('item_name');
        $test_val_upper = strtoupper($test_val);

        foreach ($gat_all_farm as $item_name) {
            if (similar_text($test_val_upper, strtoupper($item_name)) > 99) {
                return true;
            }
        }

        return false;
    }

    public function saveData($data)
    {
        if (!$this->validate()) {
            return redirect('/item')
                ->with(
                    'danger_message',
                    'Invalid Input!'
                );
        }

        if ($this->test_similarity($this->item_name)) {
            return redirect('/item')
                ->with(
                    'danger_message',
                    'Invalid Input, Duplicate Data Found!'
                );
        }

        if (!$this->validateArray($data)) {
            return redirect('/item')
                ->with(
                    'danger_message',
                    'Invalid Input, Double Check Inputs!'
                );
        }


        //[x]: validate everything first, then insert item, get id of the item
        // dd($this->selectedFarm);
        $item = new Item;
        $item->item_name = strtoupper($this->item_name);
        $item->farm_id = $this->selectedFarm;
        $item->active_status = 1;
        $item->save();

        // [action, table, old_value, new_value]
        $log_entry = [
            'new',
            'item',
            '',
            $item,
        ];
        AC::logEntry($log_entry);

        // dd($item->id);
        $this->item_id = $item->id;
        $data = array_map(function ($d) {
            $d['item_id'] = $this->item_id;
            $d['created_at'] = now();
            return $d;
        }, $data);


        //[x]: loop to everything insert item_id, created_at (like sir Adam)
        $this->tableData = $data;
        ItemFormula::insert($data);

        // Loop through each item
        foreach ($this->tableData as &$item) {
            // Update active_status to 0
            $item['active_status'] = 1;

            // Log the changes
            $log_entry = [
                'add formula',
                'item_formula',
                '',
                json_encode($item),

            ];
            AC::logEntry($log_entry);
        }

        return redirect('/item')
            ->with(
                'success_message',
                // strtoupper($this->tableData) . ' has been Successfully Created!'
                'Formula has been Successfully Created!'
            );
    }

    //[x]: function, check the array for validations("", "letters", "scripts")
    public function validateArray(array $data)
    {
        $valid = true;
        foreach ($data as $row) {
            foreach ($data as $row) {
                if (!is_numeric($row['standard'])) {
                    $valid = false;
                    break 2;
                }
            }
        }
        return $valid;
    }
}
