<?php

namespace App\Http\Livewire;

use App\Models\ElectricCost;
use Carbon\Carbon;
use Livewire\Component;
use App\Http\Controllers\AuditController as AC;

class ViewElectricCost extends Component
{
    public $latest;
    public $electric_cost;

    public $date_now;

    public function render()
    {
        return view('livewire.view-electric-cost');
    }

    public function mount($id)
    {
        // Convert "May 2023" to a date object
        $date = Carbon::createFromFormat('F Y', $id);



        // Get the start and end dates of the month
        $startOfMonth = $date->startOfMonth()->toDateTimeString();
        $endOfMonth = $date->endOfMonth()->toDateTimeString();

        // #NOTE: lastest data of the month
        $latest = ElectricCost::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->where('active_status', 1)
            ->latest('id')
            ->first();
        $this->latest = $latest;
        $this->electric_cost = $latest->electric_cost;
        // dd($latest, date($startOfMonth), date($endOfMonth));

        $this->date_now = $latest->created_at->format('Y-m-d');
    }

    public function valOnly()
    {
        $this->validate();
    }

    protected $rules = [
        'electric_cost' => 'required|numeric'
    ];

    public function update($id)
    {
        if (!$this->validate()) {
            return;
        }

        $to_save = new ElectricCost();
        $to_save->electric_cost = $this->electric_cost;
        $to_save->active_status = 1;
        $to_save->created_at = $this->date_now;

        $to_remove = ElectricCost::findorfail($id);
        $to_remove->active_status = 0;

        if ($to_remove->save() && $to_save->save()) {
            return redirect('/bills')
                ->with(
                    'success_message',
                    'Electric Cost has been Successfully Updated!'
                );
        } else {
            return redirect('/farm')
                ->with('danger_message', 'Error in Database!');
        }

        // [ ]:audit logs to be fixed
        // [action, table, old_value, new_value]
        $log_entry = [
            'update',
            'electric_costs',
            '',
            $electric_cost_data,
        ];
        AC::logEntry($log_entry);
    }
}
