<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\FarmLocation;
use App\Models\Farm;

class UpdateFarmLocation extends Component
{
    public $farm_location_id;
    public $farm_location_array = [];
    public $farm_location;
    public $selectedCategory;
    public $farm_name;
    public $farms = [];
    public $farm;

    /**
     * To Render Component To The Views.
     * @param no parameter
     * @return All Values And Render It To The View
     */
    public function render()
    {
        return view('livewire.update-farm-location');
    }

    /**
     * To Assign Null Value For The Following Fields.
     * @param id
     * @return farm_id = id
     */
    public function mount($id)
    {
        $this->farm_location_id = $id;
        $this->farm_location_array = FarmLocation::findorfail($id);
        $this->farm_location = $this->farm_location_array['farm_location'];
        $this->farm_name = $this->farm_location_array['farm_name'];
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
     * To update a record
     * @param null
     * @return null
     */
    public function update()
    {
        if (!$this->validate()) {
            return redirect('/dashboard');
        }

        $Farm = new FarmLocation();
        $Farm->farm_location = $this->farm_location;
        $Farm->farm = $this->selectedCategory;
        $Farm->active_status = 1;

        // if ($this->test_similarity($this->farm_name)) {
        //     return redirect('/raw_materials')->with('danger_message', 'Invalid Input, Duplicate Data Found!');
        // }

        $to_remove = FarmLocation::findorfail($this->farm_id);
        $to_remove->active_status = 0;

        if ($to_remove->save() && $Farm->save()) {
            return redirect('/farm')->with('success_message', 'Task Has Been Succesfully Updated!');
        } else {
            return redirect('/farm')->with('danger_message', 'Error in Database!');
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

    /**
     * To go view (Create Farm Location)
     * @param no parameter
     * @return view
     */
    public function go_to_create()
    {
        $farms = Farm::where('active_status', 1)->get();
        // return $farms;
        return view('records_inventory.farm.create_farm_location')->with('farms', $farms);
    }

    /**
     * To get farm options from DB and display as options in HTML select
     * @param no param
     * @return options
     */
    public function getFarmOptions()
    {
        $farms = Farm::all();

        $options = '';
        foreach ($farms as $farm) {
            $options .= '<option value="' . $farm->id . '">' . $farm->name . '</option>';
        }

        return $options;
    }

    public function redirect_back_with_action()
    {
        return redirect('/home')->with('cancel_message', 'Cancelled!');
    }
}
