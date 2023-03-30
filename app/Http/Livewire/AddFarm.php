<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Controllers\AuditController as AC;
use App\Models\Farm;

class AddFarm extends Component
{
    public $farm_name;

    /**
     * To Render Component To The Views.
     * @param no parameter
     * @return All Values And Render It To The View
     */
    public function render()
    {
        return view('livewire.add-farm');
    }


    /**
     * When Called It Will Create A Real-Time Validation.
     * @param no parameter
     * @return farm_name = null
     * @return standard_days = null
     * @return selectedCategory = null
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
        'farm_name' => 'required|string|min:5|max:64|unique:farms,farm_name',
    ];


    /**
     * To Test and Compare The Similarities of 2 Strings.
     * @param $test_val
     * @return true or false
     */
    public function test_similarity($test_val)
    {
        $gat_all_farm = Farm::where('active_status', 1)->pluck('farm_name');
        $test_val_upper = strtoupper($test_val);

        foreach ($gat_all_farm as $farm_name) {
            if (similar_text($test_val_upper, strtoupper($farm_name)) > 99) {
                return true;
            }
        }

        return false;

        /*$gat_all_farm = Farm::where('active_status', 1)->get();
        $val = "";
        $bool_val = false;

        foreach ($gat_all_farm as $num => $farm_name) {
            $sim_val = similar_text(strtoupper($test_val), strtoupper($farm_name->farm_name), $perc);
            if ($perc > 99) {
                $bool_val = true;
                break;
            }
        }

        return $bool_val;*/
    }

    /**
     * To Create New Record (Description).
     * @param no parameter
     * @return sucess || unsuccess
     */
    public function create()
    {
        /*if ($this->validate()) {
            $raw_Materials = new Farm();
            $raw_Materials->farm_name = $this->farm_name;
            $raw_Materials->active_status = 1;

            if ($this->test_similarity($this->farm_name) == true) {
                return redirect('/farm/farm')->with('danger_message', 'Invalid Input, Duplicate Data Found!');
            } else {
                if ($raw_Materials->save()) {
                    return redirect('/farm')->with('success_message', 'Task Has Been Succesfully Created!');
                } else {
                    return redirect('/farm/farm')->with('danger_message', 'DATABASED ERROR!');
                }
            }
        }*/

        if (!$this->validate()) {
            return;
        }

        if ($this->test_similarity($this->farm_name)) {
            return redirect('/farm/farm')
                ->with(
                    'danger_message',
                    'Invalid Input, Duplicate Data Found!'
                );
        }

        $farm = Farm::create([
            'farm_name' => strtoupper($this->farm_name),
            'active_status' => 1,
        ]);

        // [action, table, old_value, new_value]
        $log_entry = [
            'new',
            'systems',
            '',
            $farm,
        ];
        AC::logEntry($log_entry);

        return redirect('/farm/farm')
            ->with(
                'success_message',
                strtoupper($this->farm_name) . ' has been Successfully Created!'
            );
    }

}
