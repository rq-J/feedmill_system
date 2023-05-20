<?php

namespace App\Http\Livewire;

use App\Models\ElectricCost;
use Carbon\Carbon;
use Livewire\Component;
use App\Http\Controllers\AuditController as AC;

class AddElectricCost extends Component
{
    public $electric_cost;

    public $date_now;

    public function render()
    {
        return view('livewire.add-electric-cost');
    }

    public function mount()
    {
        $this->date_now = Carbon::now()->format('Y-m-d');
    }

    public function valOnly()
    {
        $this->validate();
    }

    protected $rules = [
        'electric_cost' => 'required|numeric'
    ];

    public function create()
    {
        if (!$this->validate()) {
            return;
        }

        $electric_cost_data = ElectricCost::create([
            'electric_cost' => $this->electric_cost,
            'active_status' => 1,
            'created_at' => $this->date_now,
        ]);

        // [action, table, old_value, new_value]
        $log_entry = [
            'new',
            'electric_costs',
            '',
            $electric_cost_data,
        ];
        AC::logEntry($log_entry);

        return redirect('/bills')
            ->with(
                'success_message',
                'Electric Cost has been Successfully Created!'
            );
    }
}
