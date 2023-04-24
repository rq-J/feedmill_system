<?php

namespace App\Http\Livewire;

use App\Models\ItemFormula;
use Livewire\Component;

class AddItemDaily extends Component
{
    public $arrMacro = [];
    public $arrMicro = [];
    public $arrMedicine = [];

    public $item_ids = [];

    public function render()
    {
        // dd($this->arrMacro);
        return view('livewire.add-item-daily');
    }

    public function mount()
    {
        $this->arrMacro = ItemFormula::where('item_formulas.active_status', 1)
            ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
            ->where('raw_materials.category', '=', 'MACRO')
            ->get();
        $this->arrMicro = ItemFormula::where('item_formulas.active_status', 1)
            ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
            ->where('raw_materials.category', '=', 'MICRO')
            ->get();
        $this->arrMedicine = ItemFormula::where('item_formulas.active_status', 1)
            ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
            ->where('raw_materials.category', '=', 'MEDICINE')
            ->get();

        $this->item_ids = ItemFormula::where('active_status', 1)
            ->select('item_formulas.item_id') //Get id
            ->distinct() //Get unique id
            ->get();
    }
}
