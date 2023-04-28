<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Farm;
use App\Http\Controllers\AuditController as AC;

class AddItem extends Component
{
    public $item_name;
    public $farms;
    public $selectedFarm;

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

    /**
     * To Create New Record (Description).
     * @param no parameter
     * @return sucess || unsuccess
     */
    public function create()
    {
        if (!$this->validate()) {
            return;
        }

        if ($this->test_similarity($this->item_name)) {
            return redirect('/item')
                ->with(
                    'danger_message',
                    'Invalid Input, Duplicate Data Found!'
                );
        }

        $item = item::create([
            'item_name' => strtoupper($this->item_name),
            'farm_id' => $this->selectedFarm,
            'active_status' => 1,
        ]);

        // [action, table, old_value, new_value]
        $log_entry = [
            'new',
            'item',
            '',
            $item,
        ];
        AC::logEntry($log_entry);

        return redirect('/item')
            ->with(
                'success_message',
                strtoupper($this->item_name) . ' has been Successfully Created!'
            );
    }
}
