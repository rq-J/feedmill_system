<?php

namespace App\Http\Livewire;

use App\Http\Controllers\AuditController as AC;
use App\Models\Item;
use App\Models\ItemFormula;
use App\Models\RawMaterial;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;

class AddFormula extends Component
{

    public function mount($id = null)
    {

    }

    public function render()
    {
        return view('livewire.add-formula');
    }
}
