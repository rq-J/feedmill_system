<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farm;
use Illuminate\Support\Facades\Crypt;
use DataTables;

class FarmInformationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $farms = Farm::all();
            $data = collect();
            if ($farms->count() > 0) {
                foreach ($farms as $f) {
                    $data->push([
                        'farm_name' => $f->farm_name,
                        'status' => $f->active_status == 1 ? '<span class="badge bg-success">Enabled</span>' : '<span class="badge bg-danger">Disabled</span>',
                        // 'action' => $f->active == 1 ? '<button id="update" data-id="' . Crypt::encryptString($f->id) . '" data-name="'  . $f->first_name . ' ' . $f->last_name . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> <button id="disable" data-id="' . Crypt::encryptString($f->id) . '" data-name="'  . $f->first_name . ' ' . $f->last_name . '" class="btn btn-danger btn-sm"><i class="fa fa-user-lock"></i></button>' : '<button id="enable" data-id="' . Crypt::encryptString($f->id) . '" data-name="'  . $f->first_name . ' ' . $f->last_name . '" class="btn btn-success btn-sm"><i class="fa fa-user-check"></i></button>'
                    ]);
                }
            }
            return DataTables::of($data)
                ->rawColumns(['status'])
                ->make(true);
        }
        // return $data;
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

    // public function boar_sow(Request $request)
    // {
    //     //return Farm::table('boar_sows')->orderBy('date_of_birth', 'DESC')->first();

    //     if($request->ajax()) {
    //         $farm = Farm::table('farms')->where('active_status', 1)->get();
    //         $data = collect();
    //         if(count($farm) > 0) {
    //             $this->call_boar_sow_list($farm, $data);
    //         }
    //         return DataTables::of($data)->rawColumns(['action', 'status'])->make(true);
    //     }
    //     // $breed_list = Breed::where('active_status', 1)->orderBy('breed', 'ASC')->get();
    //     // return view('boar_sow.boar_sow', ['breed_list' => $breed_list]);  v
    // }

    // public function call_boar_sow_list($boars_sows, $data = null)
    // {
    //     $ctr = 1;
    //     foreach($boars_sows as $bs) {
    //         // $breed_breed = Breed::findorfail($bs->breed_id)->breed;
    //         $data->push([
    //             // 'id' => $ctr,
    //             // 'code' => $bs->code,
    //             // 'dam_code' => empty($bs->dam_code) ? 'N/A' : $bs->dam_code,
    //             // 'sire_code' => empty($bs->sire_code) ? 'N/A' : $bs->sire_code,
    //             // 'date_of_birth' => empty($bs->date_of_birth) ? 'N/A' : $bs->date_of_birth,
    //             // 'breed' => $breed_breed == null ? "" : strtoupper($breed_breed),
    //             // 'type' => strtoupper($bs->pig_type),
    //             'farm_name' => $bs->farm_name,
    //             'status' => ($bs->boar_sow_status == 1 ? '<span class="badge badge-success"> AVAILABLE </span>' : '<span class="badge badge-secondary"> NOT AVAILABLE </span>'),
    //             'action' =>
    //                 (ACC::checkAccess(Auth::user()->id, 'boar_sow_update') ? '
    //                     <a href="' . route('boar_sow.show', ['id' => Crypt::encryptString($bs->id)]) . '"' .  " class='btn btn-success btn-sm'><i class='fas fa-edit'></i>
    //                         UPDATE
    //                     </a>" : "") .
    //                 (ACC::checkAccess(Auth::user()->id, 'boar_sow_delete') ? "|
    //                     <a href='" . route('boar_sow') . "?id=" . Crypt::encryptString($bs->id) . "&code=" . $bs->code . "' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i>
    //                         DELETE
    //                     </a>" : "") .
    //                 (ACC::checkAccess(Auth::user()->id, 'boar_sow_delete') == false && ACC::checkAccess(Auth::user()->id, 'boar_sow_update') == false ? '<a class="btn btn-info disabled">N/A</a>' : "")
    //         ]);
    //         $ctr++;
    //     }
    // }




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
