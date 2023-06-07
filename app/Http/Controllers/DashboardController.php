<?php

namespace App\Http\Controllers;

use App\Models\ElectricCost;
use App\Models\Payroll;
use App\Models\ProductionData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class DashboardController extends Controller
{
    public function dashboard()
    {
        $currentYear = Carbon::now()->year;
        $result = [];
        $production_data = ProductionData::selectRaw('YEAR(created_at) AS year, MONTH(created_at) AS month, SUM(tons_produced) AS total')
            ->where('active_status', 1)
            ->whereYear('created_at', $currentYear)
            ->groupBy('year', 'month')
            ->orderBy('month')
            ->get();

        $electric_cost = ElectricCost::selectRaw('YEAR(created_at) AS year, MONTH(created_at) AS month, SUM(electric_cost) AS electric_cost')
            ->where('active_status', 1)
            ->whereYear('created_at', $currentYear)
            ->groupBy('year', 'month')
            ->orderBy('month')
            ->get();

        $labor_cost = Payroll::selectRaw('YEAR(created_at) AS year, MONTH(created_at) AS month, SUM(salary_15) AS salary_15, SUM(salary_30) AS salary_30, SUM(allowance_15) AS allowance_15, SUM(allowance_30) AS allowance_30, SUM(overtime_15) AS overtime_15, SUM(overtime_30) AS overtime_30, SUM(month_13th_15) AS month_13th_15, SUM(month_13th_30) AS month_13th_30')
            ->where('active_status', 1)
            ->whereYear('created_at', $currentYear)
            ->groupBy('year', 'month')
            ->orderBy('month')
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
        return view('dashboard')->with('result', $result);
    }
}
