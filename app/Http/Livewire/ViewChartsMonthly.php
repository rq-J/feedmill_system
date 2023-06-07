<?php

namespace App\Http\Livewire;

use App\Models\ElectricCost;
use App\Models\Payroll;
use App\Models\ProductionData;
use Carbon\Carbon;
use Livewire\Component;

class ViewChartsMonthly extends Component
{
    public $entries = [];
    public $kilowatt = [];
    public $man_hour = [];
    public $overtime_cost = [];
    public $month_labels = [];
    public $ton_day = [];
    public $ton_hour = [];

    public function mount($result)
    {
        $this->entries = $result;
        $data = collect();
        if ($this->entries > 0) {
            foreach ($this->entries as $e) {
                $data->push([
                    // 'year' => $e['year'],
                    'month' => $e['month'],
                    // 'total_tons' => $e['total_tons'],
                    // 'electric_cost' => $e['electric_cost'],
                    // 'labor' => $e['labor'],
                    // 'overtime' => $e['overtime'],
                    'kilowatt' => ($e['electric_cost'] / $e['total_tons']) / 1000,
                    'man_hour' => ($e['labor'] / $e['total_tons']) / 1000,
                    'overtime_cost' => ($e['overtime'] / $e['total_tons']) / 1000
                ]);
            }
        }

        $kilowatt = [];
        foreach ($data as $d) {
            $kilowatt[$d['month']] = $d['kilowatt'];
        }
        $man_hour = [];
        foreach ($data as $d) {
            $man_hour[$d['month']] = $d['man_hour'];
        }
        $overtime_cost = [];
        foreach ($data as $d) {
            $overtime_cost[$d['month']] = $d['overtime_cost'];
        }

        $labels = [
            1 => 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];

        foreach ($labels as $month => $name) {
            if (!array_key_exists($month, $kilowatt)) {
                $kilowatt[$month] = 0;
            }

            if (!array_key_exists($month, $man_hour)) {
                $man_hour[$month] = 0;
            }

            if (!array_key_exists($month, $overtime_cost)) {
                $overtime_cost[$month] = 0;
            }
        }

        ksort($kilowatt);
        ksort($man_hour);
        ksort($overtime_cost);
        // dd($kilowatt, $man_hour, $overtime_cost);

        $this->kilowatt = $kilowatt;
        $this->man_hour = $man_hour;
        $this->overtime_cost = $overtime_cost;
        $this->month_labels = $labels;

        $data_tons_per_hour = ProductionData::selectRaw('YEAR(created_at) AS year, MONTH(created_at) AS month, DAY(created_at) as day, AVG(tons_per_hour) AS total')
            ->where('active_status', 1)
            ->groupBy('year', 'month', 'day')
            ->orderBy('day')
            ->get();

        $data_tons_produced = ProductionData::selectRaw('YEAR(created_at) AS year, MONTH(created_at) AS month, DAY(created_at) as day, SUM(tons_produced) AS total')
            ->where('active_status', 1)
            ->groupBy('year', 'month', 'day')
            ->orderBy('day')
            ->get();

        $ton_hour = [];
        foreach ($data_tons_per_hour as $d) {
            $ton_hour[$d['year'] . '-' . $d['month'] . '-' . $d['day']] = $d['total'];
        }

        $ton_day = [];
        foreach ($data_tons_produced as $d) {
            $ton_day[$d['year'] . '-' . $d['month'] . '-' . $d['day']] = $d['total'];
        }
        // dd($ton_hour, $ton_day);

        $this->ton_day = $ton_day;
        $this->ton_hour = $ton_hour;
    }

    public function render()
    {
        // dd($this->month_labels, $this->kilowatt);
        return view('livewire.view-charts-monthly');
    }
}
