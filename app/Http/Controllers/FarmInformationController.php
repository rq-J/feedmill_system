<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farm;

class FarmInformationController extends Controller
{
    public function index()
    {
        return view('records_inventory.farm_information');
    }

    /**
     * To go livewire view
     * @param no parameter
     * @return view
     */
    public function f_add()
    {
        return view('records_inventory.farm_information.create_farm');
    }

    /**
     * Show to be updated
     * @param id
     * @return view and decrypted id
     */
    public function f_show($id)
    {
        return view('records_inventory.farm_information.update_farm')->with('id', $id);
    }

    /**
     * To remove a record(active status = o)
     * @param id
     * @return null
     */
    public function f_remove($id)
    {
        $to_remove = Farm::findorfail($id);
        $to_remove->active_status = 0;

        if ($to_remove->save()) {
            return redirect('/farm_information')->with('success_message', 'Task Has Been Succesfully Deleted!');
        }

        return redirect('/farm_information/farm')->with('danger_message', 'Error in Database!');
    }


    /**
     * To go view (Create Farm Location)
     * @param no parameter
     * @return view
     */
    public function l_add()
    {
        $farms = Farm::where('active_status', 1)->get();
        // return $farms;
        return view('records_inventory.farm_information.create_farm_location')->with('farms', $farms);
    }

    /**
     * Show to be updated
     * @param id
     * @return view and decrypted id
     */
    public function l_show($id)
    {
        return view('records_inventory.farm_information.update_farm_location')->with('id', $id);
    }

    /**
     * To remove a record(active status = o)
     * @param id
     * @return null
     */
    public function l_remove($id)
    {
        // $to_remove = Farm::findorfail($id);
        // $to_remove->active_status = 0;

        // if ($to_remove->save()) {
        //     return redirect('/farm_information')->with('success_message', 'Task Has Been Succesfully Deleted!');
        // }

        // return redirect('/farm_information/farm')->with('danger_message', 'Error in Database!');
    }
}
