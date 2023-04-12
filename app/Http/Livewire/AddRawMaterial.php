<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\RawMaterial;

class AddRawMaterial extends Component
{
    public $raw_material_name;
    public $standard_days;
    public $selectedCategory;

    public $categories = [
        'Macro',
        'Micro',
        'Medicine',
    ];


    /**
     * To Render Component To The Views.
     * @param no parameter
     * @return All Values And Render It To The View
     */
    public function render()
    {
        return view('livewire.add-raw-material');
    }

    /**
     * To Assign Null Value For The Following Fields.
     * @param no parameter
     * @return raw_material_name = null
     * @return standard_days = null
     * @return category = null
     */
    public function mount()
    {
        $this->raw_material_name = null;
        $this->standard_days = null;
        $this->selectedCategory = 'micro';
    }

    /**
     * When Called It Will Create A Real-Time Validation.
     * @param no parameter
     * @return raw_material_name = null
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
        'raw_material_name' => 'required|string|min:5|max:255|unique:raw_materials,raw_material_name',
        'standard_days' => 'required|integer|min:1|max:180'
    ];

    /**
     * To Test and Compare The Similarities of 2 Strings.
     * @param $test_val
     * @return true or false
     */
    public function test_similarity($test_val)
    {
        $get_all_raw_materials = RawMaterial::where('active_status', 1)->get();
        $val = "";
        $bool_val = false;

        foreach ($get_all_raw_materials as $num => $raw_material_name) {
            $sim_val = similar_text(strtoupper($test_val), strtoupper($raw_material_name->raw_material_name), $perc);
            if ($perc > 95) {
                $bool_val = true;
                break;
            }
        }

        return $bool_val;
    }

    /**
     * To Create New Record (Description).
     * @param no parameter
     * @return sucess || unsuccess
     */
    public function create()
    {
        // return redirect('/dashboard');
        if ($this->validate()) {
            $raw_Materials = new RawMaterial();
            $raw_Materials->raw_material_name = $this->raw_material_name;
            $raw_Materials->standard_days = $this->standard_days;
            $raw_Materials->category = strtoupper($this->selectedCategory);
            $raw_Materials->active_status = 1;

            if ($this->test_similarity($this->raw_material_name) == true) {
                return redirect('/raw')->with('danger_message', 'Invalid Input, Duplicate Data Found!');
            } else {
                if ($raw_Materials->save()) {
                    return redirect('/raw')->with('success_message', 'Task Has Been Succesfully Created!');
                } else {
                    return redirect('/raw')->with('danger_message', 'DATABASED ERROR!');
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
