<?php

namespace App\Http\Controllers;

use App\Models\QualityAssurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use App\Http\Controllers\AuditController as AC;
use App\Models\Downtime;

class PivotController extends Controller
{
    public function index()
    {
        return view('reports.pivot_logs');
    }

    public function qa_index(Request $request)
    {
        //DataTable
        if ($request->ajax()) {
            $qa = QualityAssurance::where('active_status', 1)->get();
            // $qa = RawMaterial::all();
            $data = collect();
            if ($qa->count() > 0) {
                foreach ($qa as $q) {
                    $data->push([
                        'code' => $q->code,
                        'description' => $q->description,
                        'action' => '<button id="update" data-id="' . Crypt::encryptString($q->id) . '" data-name="'  . $q->raw_material_name . '" class="btn btn-primary btn-sm">UPDATE</button>
                        <button id="remove" data-id="' . Crypt::encryptString($q->id) . '" data-name="'  . $q->raw_material_name . '" class="btn btn-danger btn-sm">REMOVE</button>'
                    ]);
                }
            }

            return DataTables::of($data)
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('reports.pivot_log.quality_assurance');
    }

    public function qa_update($id = null)
    {
        return view('reports.pivot_log.update_quality_assurance')
            ->with('id', Crypt::decryptString($id));
    }

    public function qa_remove($id = null)
    {
        try {
            $id = Crypt::decryptString($id);
        } catch (\Throwable $e) {
            return $e;
        }

        $qa = QualityAssurance::findorfail($id);
        $qa_old = $qa;
        $qa->active_status = 0;
        if ($qa->save()) {

            // [action, table, old_value, new_value]
            $log_entry = [
                'remove',
                'quality_assurances',
                $qa_old,
                '',
            ];
            AC::logEntry($log_entry);

            return redirect('/pivot/quality_assurance')
                ->with('success_message', 'Task Has Been Succesfully Deleted!');
        }
        return redirect('/pivot/quality_assurance')
            ->with('danger_message', 'Error in Database!');
    }

    public function dt_index(Request $request)
    {
        if ($request->ajax()) {
            $qa = Downtime::where('active_status', 1)->get();
            // $qa = RawMaterial::all();
            $data = collect();
            if ($qa->count() > 0) {
                foreach ($qa as $q) {
                    $data->push([
                        'no' => $q->no,
                        'code' => $q->code,
                        'description' => $q->description,
                        'action' => '<button id="update" data-id="' . Crypt::encryptString($q->id) . '" data-name="'  . $q->code . '" class="btn btn-primary btn-sm">UPDATE</button>
                        <button id="remove" data-id="' . Crypt::encryptString($q->id) . '" data-name="'  . $q->code . '" class="btn btn-danger btn-sm">REMOVE</button>'
                    ]);
                }
            }

            return DataTables::of($data)
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('reports.pivot_log.downtime');
    }

    public function dt_update($id = null)
    {
        return view('reports.pivot_log.update_downtime')
            ->with('id', Crypt::decryptString($id));
    }

    public function dt_remove($id = null)
    {
        try {
            $id = Crypt::decryptString($id);
        } catch (\Throwable $e) {
            return $e;
        }

        $dt = Downtime::findorfail($id);
        $dt_old = $dt;
        $dt->active_status = 0;
        if ($dt->save()) {

            // [action, table, old_value, new_value]
            $log_entry = [
                'remove',
                'downtimes',
                $dt_old,
                '',
            ];
            AC::logEntry($log_entry);

            return redirect('/pivot/downtime')
                ->with('success_message', 'Downtime Has Been Succesfully Deleted!');
        }
        return redirect('/pivot/downtime')
            ->with('danger_message', 'Error in Database!');
    }
}
