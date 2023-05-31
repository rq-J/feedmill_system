<?php

namespace App\Http\Controllers;

use App\Models\QualityAssurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use App\Http\Controllers\AuditController as AC;
use App\Models\Downtime;
use App\Models\ElectricCost;
use App\Models\Payroll;
use App\Models\ProductionData;
use Error;
use Exception;
use Illuminate\Support\Facades\DB;

class PivotController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $result = [];
            $production_data = ProductionData::selectRaw('YEAR(created_at) AS year, MONTH(created_at) AS month, SUM(tons_produced) AS total')
                ->groupBy('year', 'month')
                ->where('active_status', 1)
                ->get();

            $electric_cost = ElectricCost::selectRaw('YEAR(created_at) AS year, MONTH(created_at) AS month, SUM(electric_cost) AS electric_cost')
                ->groupBy('year', 'month')
                ->where('active_status', 1)
                ->get();

            $labor_cost = Payroll::selectRaw('YEAR(created_at) AS year, MONTH(created_at) AS month, SUM(salary_15) AS salary_15, SUM(salary_30) AS salary_30, SUM(allowance_15) AS allowance_15, SUM(allowance_30) AS allowance_30, SUM(overtime_15) AS overtime_15, SUM(overtime_30) AS overtime_30, SUM(month_13th_15) AS month_13th_15, SUM(month_13th_30) AS month_13th_30')
                ->groupBy('year', 'month')
                ->where('active_status', 1)
                ->get();

            $productionDataByYearMonth = [];
            foreach ($production_data as $data) {
                $productionDataByYearMonth[$data->year][$data->month] = $data;
            }

            foreach ($electric_cost as $cost) {
                foreach ($labor_cost as $labor) {
                    if (isset($productionDataByYearMonth[$cost->year][$cost->month]) && $cost->year == $labor->year && $cost->month == $labor->month) {
                        $data = $productionDataByYearMonth[$cost->year][$cost->month];
                        $result[] = [
                            'total_tons' => $data->total,
                            'electric_cost' => $cost->electric_cost,
                            'labor' => $labor->salary_15 + $labor->salary_30 + $labor->allowance_15 + $labor->allowance_30,
                            'overtime' => $labor->overtime_15 + $labor->overtime_30,
                            'month' => $data->month,
                            'year' => $cost->year
                        ];
                    }
                }
            }

            // dd($result);
            $months = [
                1 => 'January',
                2 => 'February',
                3 => 'March',
                4 => 'April',
                5 => 'May',
                6 => 'June',
                7 => 'July',
                8 => 'August',
                9 => 'September',
                10 => 'October',
                11 => 'November',
                12 => 'December',
            ];

            $data = collect();
            if ($result > 0) {
                foreach ($result as $q) {
                    $data->push([
                        'year' => $q['year'],
                        'month' => $months[$q['month']],
                        'total_tons' => $q['total_tons'],
                        'electric_cost' => $q['electric_cost'],
                        'labor' => $q['labor'],
                        'overtime' => $q['overtime'],
                        'kilowatt' => ($q['electric_cost'] / $q['total_tons']) / 1000,
                        'man_hour' => ($q['labor'] / $q['total_tons']) / 1000,
                        'overtime_cost' => ($q['overtime'] / $q['total_tons']) / 1000
                        // 'action' => '<button id="update" data-id="' . Crypt::encryptString($q->id) . '" data-name="'  . $q->raw_material_name . '" class="btn btn-primary btn-sm">UPDATE</button>
                        // <button id="remove" data-id="' . Crypt::encryptString($q->id) . '" data-name="'  . $q->raw_material_name . '" class="btn btn-danger btn-sm">REMOVE</button>'
                    ]);
                }
            }

            return DataTables::of($data)
                ->rawColumns(['year'])
                ->make(true);
        }

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
