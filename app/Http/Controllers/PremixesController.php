<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PremixesController extends Controller
{
    public function index()
    {
        // $items = [];

        // WILL READ THE PREMIX
        // $this->items = Premix::select('items.item_name', 'farms.farm_name', 'raw_materials.category', 'item_formulas.*')
        //     ->where('item_formulas.active_status', 1)
        //     ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
        //     ->join('items', 'item_formulas.item_id', '=', 'items.id')
        //     ->join('farms', 'items.farm_id', '=', 'farms.id')
        //     ->where('raw_materials.category', '=', 'MACRO')
        //     ->get();


        return view('production_management.premixes');
    }
}
