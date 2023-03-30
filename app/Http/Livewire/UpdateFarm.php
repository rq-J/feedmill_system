<?php

namespace App\Http\Livewire;

use App\Models\Farm;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class UpdateFarm extends Component
{
    public $farm_name;
    public $farm_id;
    public $farm = [];


    /**
     * To Render Component To The Views.
     * @param no parameter
     * @return All Values And Render It To The View
     */
    public function render()
    {
        return view('livewire.update-farm');
    }

    /**
     * To Assign Null Value For The Following Fields.
     * @param id
     * @return farm_id = id
     */
    public function mount($id)
    {
        $this->farm_id = $id;
        $this->farm = Farm::findorfail($id);
        [
            $this->farm_name
        ] = [
            $this->farm->farm_name
        ];
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
        'farm_name' => 'required|string|min:5|max:255|unique:farms,farm_name'
    ];

    /**
     * To Test and Compare The Similarities of 2 Strings.
     * @param $test_val
     * @return true or false
     */
    public function test_similarity($test_val)
    {
        $get_all_raw_materials = Farm::where('active_status', 1)->get();

        foreach ($get_all_raw_materials as $num => $farm_name) {
            $sim_val = similar_text(strtoupper($test_val), strtoupper($farm_name->farm_name), $perc);
            if ($perc > 95) {
                return true;
            }
        }

        return false;
    }


    /**
     * To update a record
     * @param null
     * @return null
     */
    public function update()
    {
        if (!$this->validate()) {
            return redirect('/dashboard');
        }

        $Farm = new Farm();
        $Farm->farm_name = $this->farm_name;
        $Farm->active_status = 1;

        // if ($this->test_similarity($this->farm_name)) {
        //     return redirect('/raw_materials')->with('danger_message', 'Invalid Input, Duplicate Data Found!');
        // }

        $to_remove = Farm::findorfail($this->farm_id);
        $to_remove->active_status = 0;

        if ($to_remove->save() && $Farm->save()) {
            return redirect('/farm')->with('success_message', 'Task Has Been Succesfully Updated!');
        } else {
            return redirect('/farm')->with('danger_message', 'Error in Database!');
        }
    }
}
