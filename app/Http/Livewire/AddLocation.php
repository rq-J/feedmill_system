<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Farm;
use App\Models\FarmLocation;

class AddLocation extends Component
{
    public $farm_location;
    public $selectedCategory = 1;
    public $farm_name;
    public $farms;

    public function mount($farms)
    {
        $this->farms = $farms;
    }

    /**
     * To Render Component To The Views.
     * @param no parameter
     * @return All Values And Render It To The View
     */
    public function render()
    {
        return view('livewire.add-location');
    }

    /**
     * When Called It Will Create A Real-Time Validation.
     * @param no parameter
     * @return farm_location = null
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
        'farm_location' => 'required|string|min:5|max:255|unique:farm_locations,farm_location'
    ];

    /**
     * To Test and Compare The Similarities of 2 Strings.
     * @param $test_val
     * @return true or false
     */
    public function test_similarity($test_val)
    {
        $gat_all_farm = FarmLocation::where('active_status', 1)->get();
        $val = "";
        $bool_val = false;

        foreach ($gat_all_farm as $num => $farm_location) {
            $sim_val = similar_text(strtoupper($test_val), strtoupper($farm_location->farm_location), $perc);
            if ($perc > 90) {
                $bool_val = true;
                break;
            }
        }

        return $bool_val;
    }

    /**
     * To Create New Record (Farm Location).
     * @param no parameter
     * @return sucess || unsuccess
     */
    public function create()
    {
        if ($this->validate()) {
            $raw_Materials = new FarmLocation();
            $raw_Materials->farm_location = $this->farm_location;
            $raw_Materials->farm_id = $this->selectedCategory;
            $raw_Materials->active_status = 1;

            if ($this->test_similarity($this->farm_location) == true) {
                return redirect('/farm/location')->with('danger_message', 'Invalid Input, Duplicate Data Found!');
            } else {
                if ($raw_Materials->save()) {
                    return redirect('/farm')->with('success_message', $this->farm_location. ' has been Succesfully Created!');
                } else {
                    return redirect('/home')->with('danger_message', 'DATABASED ERROR!');
                }
            }
        }
    }


    /**
     * To return selected catergory
     * @param category
     * @return selectedCatergory
     */
    public function categorySelected($category)
    {
        return $this->selectedCategory = $category;
    }
}
