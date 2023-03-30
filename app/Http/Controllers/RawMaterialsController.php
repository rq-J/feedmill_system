<?php

namespace App\Http\Controllers;

use App\Models\RawMaterial;
use Illuminate\Http\Request;

class RawMaterialsController extends Controller
{
    public function index()
    {
        $raw_material_data = RawMaterial::where("active_status", 1)->get();
        return view('production_management.raw_material')->with('raw_materials', $raw_material_data);
    }

    /**
     * Show to be updated
     * @param id
     * @return view and decrypted id
     */
    public function show_to_be_updated($id)
    {
        // dd($id);
        return view('production_management.raw_material.update_feeds_information')->with('id', $id);
    }

    /**
     * To remove a record(active status = o)
     * @param id
     * @return null
     */
    public function remove($id)
    {
        $to_remove = RawMaterial::findorfail($id);
        $to_remove->active_status = 0;

        if ($to_remove->save()) {
            return redirect('/raw_materials')->with('success_message', 'Task Has Been Succesfully Deleted!');
        }
        return redirect('/raw_materials')->with('danger_message', 'Error in Database!');
    }
}
