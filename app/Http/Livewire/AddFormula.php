<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\RawMaterial;
use Livewire\Component;

class AddFormula extends Component
{
    public $items;

    public $arrMacro =[];
    public $arrMicro =[];
    public $arrMedicine =[];

    public function mount()
    {
        // $this->listener = ['']; //Put the name of the Function in the ''
        $this->arrMacro =  RawMaterial::where('active_status', 1)->where('category', 'MACRO')->get();
        $this->arrMicro =  RawMaterial::where('active_status', 1)->where('category', 'MICRO')->get();
        $this->arrMedicine =  RawMaterial::where('active_status', 1)->where('category', 'MEDICINE')->get();
    }

    public function render()
    {
        return view('livewire.add-formula');
    }


}
