<?php

namespace App\Http\Controllers;

use App\Models\ElectricCost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;

class AccountingBillsController extends Controller
{
    public function index(Request $request)
    {
        $latestRecord = ElectricCost::latest('created_at')->where('active_status', 1)->first();
        $bool_month = false;

        if ($latestRecord) {
            $latestMonth = $latestRecord->created_at->format('m');
            $currentMonth = date('m');

            $bool_month = ($latestMonth == $currentMonth);
        }

        if ($request->ajax()) {
            $unique_months = ElectricCost::select('created_at')
                ->where('active_status', 1)
                ->distinct()
                // ->grouBy('created_at')
                ->orderBy(ElectricCost::raw('DATE_FORMAT(created_at, "%Y-%m")'), 'desc')
                ->get()
                ->pluck('created_at')
                ->map(function ($month) {
                    $date = Carbon::parse($month);
                    return $date->format('F Y');
                })
                ->unique()
                ->values();
            // dd($unique_months);

            $data = collect();
            if ($unique_months->count() > 0) {
                foreach ($unique_months as $u) {
                    $data->push([
                        'month_and_year' => $u,
                        'action' => '<button id="update" data-id="' . Crypt::encryptString($u) . '" data-name="'  . $u . '" class="btn btn-primary btn-sm">View</button><button id="remove" data-id="' . Crypt::encryptString($u) . '" data-name="'  . $u . '" class="btn btn-danger btn-sm">Delete</button>'
                    ]);
                }
            }

            return DataTables::of($data)
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('reports.accounting_bills')
            ->with('bool_month', $bool_month);
    }

    public function update($id)
    {
        return view('reports.accounting_bill.update_accounting_bills')
            ->with('id', Crypt::decryptString($id));
    }
}
