<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\RawMaterial;
use Illuminate\Validation\Rule;


class UpdateRawMaterial extends Component
{
    public $raw_material_name;
    public $standard_days;
    public $selectedCategory;
    public $mat_id;
    public $raw_material = [];


    /**
     * To Render Component To The Views.
     * @param no parameter
     * @return All Values And Render It To The View
     */
    public function render()
    {
        return view('livewire.update-raw-material');
    }

    /**
     * To Assign Null Value For The Following Fields.
     * @param id
     * @return mat_id = id
     * @return raw_material_name = raw_material_name
     * @return standard_days = standard_days
     * @return selectedCategory = category
     */
    public function mount($id)
    {
        $this->mat_id = $id;
        $this->raw_material = RawMaterial::findorfail($id);
        [
            $this->raw_material_name,
            $this->standard_days,
            $this->selectedCategory
        ] = [
            $this->raw_material->raw_material_name,
            $this->raw_material->standard_days,
            $this->raw_material->category
        ];
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
        'raw_material_name' => 'required|string|min:5|max:255',
        // 'raw_material_name' => 'required|string|min:5|max:255|unique:raw_materials,raw_material_name',
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

        foreach ($get_all_raw_materials as $num => $raw_material_name) {
            $sim_val = similar_text(strtoupper($test_val), strtoupper($raw_material_name->raw_material_name), $perc);
            if ($perc > 95) {
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
    // public function create()
    // {
    //     // return redirect('/dashboard');
    //     if ($this->validate()) {
    //         $raw_Materials = new RawMaterial();
    //         $raw_Materials->raw_material_name = $this->raw_material_name;
    //         $raw_Materials->standard_days = $this->standard_days;
    //         $raw_Materials->category = $this->selectedCategory;
    //         $raw_Materials->active_status = 1;

    //         if ($this->test_similarity($this->raw_material_name) == true) {
    //             // return redirect('/dashboard')->with('danger_message', 'Invalid Input, Duplicate Data Found!');
    //             return redirect('/dashboard');
    //         } else {
    //             if ($raw_Materials->save()) {
    //                 // return redirect('/home')->with('success_message', 'Task Has Been Succesfully Created!');
    //                 return redirect('/macro');
    //             } else {
    //                 // return redirect('/home')->with('danger_message', 'DATABASED ERROR!');
    //                 return redirect('/micro');
    //             }
    //         }
    //     }
    // }


    /**
     * To return selected category
     * @param category
     * @return selectedCategory
     */
    public function categorySelected($category)
    {
        return $this->selectedCategory = $category;
    }

    /**
     * To update a record
     * @param nul
     * @return null
     */
    public function update($id)
    {
        if (!$this->validate([
            'raw_material_name' => [
                'required',
                Rule::unique('raw_materials')->ignore($id),
            ],
            'standard_days' => 'required|numeric',
        ])) {
            return redirect('/raw')->with('danger_message', 'Please try again!');
        }

        $raw_Materials = new RawMaterial();
        $raw_Materials->raw_material_name = $this->raw_material_name;
        $raw_Materials->standard_days = $this->standard_days;
        $raw_Materials->category = $this->selectedCategory;
        $raw_Materials->active_status = 1;

        // if ($this->test_similarity($this->raw_material_name)) {
        //     return redirect('/raw')->with('danger_message', 'Invalid Input, Duplicate Data Found!');
        // }

        $to_remove = RawMaterial::findorfail($this->mat_id);
        $to_remove->active_status = 0;

        if ($to_remove->save() && $raw_Materials->save()) {
            return redirect('/raw')->with('success_message', 'Task Has Been Succesfully Updated!');
        } else {
            return redirect('/raw')->with('danger_message', 'Error in Database!');
        }

        /*    if ($this->validate()) {
                $raw_Materials = new RawMaterial();
                $raw_Materials->raw_material_name = $this->raw_material_name;
                $raw_Materials->standard_days = $this->standard_days;
                $raw_Materials->category = $this->selectedCategory;
                $raw_Materials->active_status = 1;

                if ($this->test_similarity($this->raw_material_name) == true) {
                    return redirect('/raw')->with('danger_message', 'Invalid Input, Duplicate Data Found!');
                    return redirect('/dashboard');
                } else {
                    $to_remove = RawMaterial::findorfail($this->mat_id);
                    $to_remove->active_status = 0;

                    if ($to_remove->save() && $raw_Materials->save()) {
                        return redirect('/raw');
                    } else {
                        return redirect('/error');
                    }
                }
            } else {
                return redirect('/dashboard');
            }
        */
    }
}
