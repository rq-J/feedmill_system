<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateItem extends Component
{
    public $item_id;
    public $item = [];
    public $item_name;

    public function render()
    {
        return view('livewire.update-item');
    }

    public function mount($id)
    {
        $this->item_id = $id;
        $this->item = Item::findorfail($id);
        $this->item_name = $this->item->item_name;
    }

    public function valOnly()
    {
        $this->validate();
    }

    protected $rules = [
        'item_name' => 'unique:items,item_name|required|string|min:3|max:255'
    ];

    public function test_similarity($test_val)
    {
        $get_all_item = Item::where('active_status', 1)->get();

        foreach ($get_all_item as $num => $item) {
            $similar_value = similar_text(strtoupper($test_val), strtoupper($item->item_name), $perc);
            if ($perc > 95) {
                return true;
            }
        }

        return false;
    }

    public function update($id)
    {
        if (!$this->validate([
            'item_name' => [
                'required',
                Rule::unique('items')->ignore($id),
            ]
        ])) {
            return redirect('/item')->with('danger_message', 'Please try again!');
        }

        $updated_item = new Item();
        $updated_item->item_name = $this->item_name;
        $updated_item->active_status = 1;

        // if ($this->test_similarity($this->raw_material_name)) {
        //     return redirect('/raw')->with('danger_message', 'Invalid Input, Duplicate Data Found!');
        // }

        $to_remove = Item::findorfail($this->item_id);
        $to_remove->active_status = 0;

        if ($to_remove->save() && $updated_item->save()) {
            return redirect('/item')->with('success_message', 'Item Has Been Succesfully Updated!');
        } else {
            return redirect('/item')->with('danger_message', 'Error in Database!');
        }
    }
}
