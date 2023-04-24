<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\FarmLocation;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use App\Http\Controllers\AuditController as AC;

class FarmInformationController extends Controller
{
    /**
     * To go view(Farm Information)
     * @param null
     * @return view
     */
    public function index()
    {
        return view('records_inventory.farm_information');
    }

    /**
     * To go livewire(Create Farm) view with dataTables
     * @param request
     * @return datatables&view
     */
    public function f_add(Request $request)
    {
        //DataTable
        if ($request->ajax()) {
            $farms = Farm::where('active_status', 1)->get();
            $data = collect();
            if ($farms->count() > 0) {
                foreach ($farms as $f) {
                    $data->push([
                        'farm_name' => $f->farm_name,
                        'status' => $f->active_status == 1 ? '<span class="badge bg-success">Enabled</span>' : '<span class="badge bg-danger">Disabled</span>',
                        'action' => $f->active_status == 1 ? '<button id="update" data-id="' . Crypt::encryptString($f->id) . '" data-name="'  . $f->farm_name . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> <button id="remove" data-id="' . Crypt::encryptString($f->id) . '" data-name="'  . $f->farm_name . '" class="btn btn-danger btn-sm"><i class="fa fa-user-lock"></i></button>' : '<button id="enable" data-id="' . Crypt::encryptString($f->id) . '" data-name="'  . $f->farm_name . '" class="btn btn-success btn-sm"><i class="fa fa-user-check"></i></button>'
                    ]);
                }
            }
            return DataTables::of($data)
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('records_inventory.farm_information.create_farm');
    }

    /**
     * Show to be updated
     * @param id
     * @return view and decrypted id
     */
    public function f_show($id)
    {
        return view('records_inventory.farm_information.update_farm')->with('id',Crypt::decryptString($id));
    }

    /**
     * To remove a record(active status = o)
     * @param id
     * @return null
     */
    public function f_remove($id)
    {
        try {
            $id = Crypt::decryptString($id);
        } catch (\Throwable $e) {
            return $e;
        }

        $farm = Farm::findorfail($id);
        $farm_old = $farm;
        $farm->active_status = 0;
        if ($farm->save()) {

            // [action, table, old_value, new_value]
            $log_entry = [
                'remove farm',
                'farms',
                $farm_old,
                '',
            ];
            AC::logEntry($log_entry);

            return redirect('/farm/farm')
                ->with('success_message', 'Task Has Been Succesfully Deleted!');
        }
        return redirect('/farm/farm')
            ->with('danger_message', 'Error in Database!');


        // $to_remove = Farm::findorfail($id);
        // $to_remove->active_status = 0;

        // if ($to_remove->save()) {
        //     return redirect('/farm_information')->with('success_message', 'Task Has Been Succesfully Deleted!');
        // }

        // return redirect('/farm_information/farm')->with('danger_message', 'Error in Database!');
    }




    /**
     * To go view (Create Farm Location) with dataTables
     * @param request
     * @return datables&view
     */
    public function l_add(Request $request)
    {
        //DataTable
        if ($request->ajax()) {
            $location = FarmLocation::where('active_status', 1)->get();
            $data = collect();
            if ($location->count() > 0) {
                foreach ($location as $l) {
                    $data->push([
                        'farm_location' => $l->farm_location,
                        'farm_name' => $l->farm->farm_name,
                        'status' => $l->active_status == 1 ? '<span class="badge bg-success">Enabled</span>' : '<span class="badge bg-danger">Disabled</span>',
                        'action' => $l->active_status == 1 ? '<button id="update" data-id="' . Crypt::encryptString($l->id) . '" data-name="'  . $l->farm_location . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> <button id="remove" data-id="' . Crypt::encryptString($l->id) . '" data-name="'  . $l->farm_location . '" class="btn btn-danger btn-sm"><i class="fa fa-user-lock"></i></button>' : '<button id="enable" data-id="' . Crypt::encryptString($l->id) . '" data-name="'  . $l->farm_location . '" class="btn btn-success btn-sm"><i class="fa fa-user-check"></i></button>'
                    ]);
                }
            }
            return DataTables::of($data)
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

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
        return view('records_inventory.farm_information.update_farm_location')->with('id',Crypt::decryptString($id));
    }

    /**
     * To remove a record(active status = o)
     * @param id
     * @return null
     */
    public function l_remove($id)
    {
        try {
            $id = Crypt::decryptString($id);
        } catch (\Throwable $e) {
            return $e;
        }

        $farm_location = FarmLocation::findorfail($id);
        $farm_location_old = $farm_location;
        $farm_location->active_status = 0;
        if ($farm_location->save()) {

            // [action, table, old_value, new_value]
            $log_entry = [
                'remove farm location',
                'farm_locations',
                $farm_location_old,
                '',
            ];
            AC::logEntry($log_entry);

            return redirect('/farm/location')
                ->with('success_message', 'Task Has Been Succesfully Deleted!');
        }
        return redirect('/farm/location')
            ->with('danger_message', 'Error in Database!');


        // $to_remove = Farm::findorfail($id);
        // $to_remove->active_status = 0;

        // if ($to_remove->save()) {
        //     return redirect('/farm_information')->with('success_message', 'Task Has Been Succesfully Deleted!');
        // }

        // return redirect('/farm_information/farm')->with('danger_message', 'Error in Database!');
    }
}
