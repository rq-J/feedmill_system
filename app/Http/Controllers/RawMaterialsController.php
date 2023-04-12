<?php

namespace App\Http\Controllers;

use App\Models\RawMaterial;
use App\Http\Controllers\AuditController as AC;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RawMaterialsController extends Controller
{
    public function index(Request $request)
    {
        //DataTable
        if ($request->ajax()) {
            $raw = RawMaterial::where('active_status', 1)->get();
            // $raw = RawMaterial::all();
            $data = collect();
            if ($raw->count() > 0) {
                foreach ($raw as $r) {
                    $data->push([
                        'raw_material_name' => $r->raw_material_name,
                        'standard_days' => $r->standard_days,
                        'category' => $r->category,
                        'action' => $r->active_status == 1 ?
                            '<button id="update" data-id="' . Crypt::encryptString($r->id) . '" data-name="'  . $r->raw_material_name . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                            <button id="remove" data-id="' . Crypt::encryptString($r->id) . '" data-name="'  . $r->raw_material_name . '" class="btn btn-danger btn-sm"><i class="fa fa-user-lock"></i></button>'
                            :
                            '<button id="enable" data-id="' . Crypt::encryptString($r->id) . '" data-name="'  . $r->raw_material_name . '" class="btn btn-success btn-sm"><i class="fa fa-user-check"></i></button>'
                    ]);
                }
            }

            return DataTables::of($data)
                ->rawColumns(['action'])
                ->make(true);
        }

        $raw_material_data = RawMaterial::where("active_status", 1)->get();

        return view('production_management.raw_material')
            ->with('raw_materials', $raw_material_data);
    }

    /**
     * Show to be updated
     * @param id
     * @return view and decrypted id
     */
    public function update($id = null)
    {
        $idRaw = Crypt::decryptString($id);

        return view('production_management.raw_material.update_feeds_information', ['action' => 'Update'])
            ->with('id', $idRaw);
    }

    /**
     * To remove a record(active status = o)
     * @param id
     * @return null
     */
    public function remove($id = null)
    {
        try {
            $id = Crypt::decryptString($id);
        } catch (\Throwable $e) {
            return $e;
        }

        $rawMaterial = RawMaterial::findorfail($id);
        $rawMaterial_old = $rawMaterial;
        $rawMaterial->active_status = 0;
        if ($rawMaterial->save()) {

            // [action, table, old_value, new_value]
            $log_entry = [
                'remove raw material',
                'raw_materials',
                $rawMaterial_old,
                '',
            ];
            AC::logEntry($log_entry);

            return redirect('/raw')
                ->with('success_message', 'Task Has Been Succesfully Deleted!');
        }
        return redirect('/raw')
            ->with('danger_message', 'Error in Database!');
    }
}
