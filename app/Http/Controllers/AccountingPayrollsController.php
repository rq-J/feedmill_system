<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Http\Controllers\AuditController as AC;

class AccountingPayrollsController extends Controller
{

    public function index(Request $request)
    {
        $latestRecord = Payroll::latest('created_at')->where('active_status', 1)->first();
        $bool_month = false;

        if ($latestRecord) {
            $latestMonth = $latestRecord->created_at->format('m');
            $currentMonth = date('m');

            $bool_month = ($latestMonth == $currentMonth);
        }

        // #NOTE: gives the unique months, but not the year
        // $another_unique_months = Payroll::select(
        //     DB::raw("MONTHNAME(created_at) as month_name")

        // )
        //     ->whereYear('created_at', date('Y'))
        //     ->groupBy('month_name')
        //     ->get()
        //     ->toArray();

        // dd($another_unique_months);

        if ($request->ajax()) {
            $unique_months = Payroll::select('created_at')
                ->where('active_status', 1)
                ->distinct()
                // ->grouBy('created_at')
                ->orderBy(Payroll::raw('DATE_FORMAT(created_at, "%Y-%m")'), 'desc')
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

        return view('reports.accounting_payrolls')
            ->with('bool_month', $bool_month);
    }

    public function view($id = null)
    {
        return view('reports.accounting_payroll.view_payroll')
            ->with('id', Crypt::decryptString($id));
    }

    public function remove($id = null)
    {
        $id = Crypt::decryptString($id);
        try {
            // Convert "May 2023" to a date object
            $date = Carbon::createFromFormat('F Y', $id);

            // Get the start and end dates of the month
            $startOfMonth = $date->startOfMonth()->toDateTimeString();
            $endOfMonth = $date->endOfMonth()->toDateTimeString();

            // #NOTE: lastest data of the month
            $latest = Payroll::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where('active_status', 1)
                ->latest('id')
                ->first();

            $latest_array = Payroll::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->where('active_status', 1)
                ->whereDate('created_at', $latest->created_at->toDateString())
                ->get();

            foreach ($latest_array as $record) {
                if ($record->active_status == 1) {
                    $to_remove = Payroll::findorfail($record->id);
                    $to_remove->active_status = 0;
                    $to_remove->save();

                    $log_entry = [
                        'remove',
                        '',
                        'payrolls',
                        json_encode($to_remove),

                    ];
                    AC::logEntry($log_entry);
                }
            }
        } catch (Exception $exception) {
            DB::rollback();
            return dd($exception);
        } catch (Throwable $throwable) {
            DB::rollback();
            return dd($throwable);
        }
    }
}
