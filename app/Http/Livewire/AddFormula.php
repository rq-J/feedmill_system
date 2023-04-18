<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\ItemFormula;
use App\Models\RawMaterial;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;

class AddFormula extends Component
{
    public $items;
    public $item_id;

    public $arrMacro = [];
    public $arrMicro = [];
    public $arrMedicine = [];

    public $tableData = [];

    protected $listeners = ['dataSaved' => 'saveData'];

    public function saveData($data)
    {
        $this->tableData = $data;
        ItemFormula::insert($data);
        dd($data);
        // Save the extracted data to your desired data storage (e.g., database)
        // You can access the 'Raw Material Name' and 'Standard' values as $this->tableData[$index]['Raw Material Name'] and $this->tableData[$index]['Standard'] respectively

        // Emit an event indicating the data was saved successfully
        $this->emit('dataSavedSuccessfully', 'Data saved successfully');
    }

    public function mount($id = null)
    {
        $this->arrMacro =  RawMaterial::where('active_status', 1)->where('category', 'MACRO')->select('id', 'raw_material_name')->get();
        $this->arrMicro =  RawMaterial::where('active_status', 1)->where('category', 'MICRO')->select('id', 'raw_material_name')->get();
        $this->arrMedicine =  RawMaterial::where('active_status', 1)->where('category', 'MEDICINE')->select('id', 'raw_material_name')->get();

        $this->item_id = $id;
    }

    public function render()
    {
        return view('livewire.add-formula');
    }
}
