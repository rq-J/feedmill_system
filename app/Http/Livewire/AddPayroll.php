<?php

namespace App\Http\Livewire;

use App\Http\Controllers\AuditController as AC;
use App\Models\Payroll;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Concerns\ToArray;

class AddPayroll extends Component
{
    public $payroll_list = [];
    public $payrolls;
    public $item_id = 1;
    public $name;
    public $position;

    public $salary_15;
    public $salary_30;
    public $overtime_15;
    public $overtime_30;
    public $allowance_15;
    public $allowance_30;
    public $month_13th_15;
    public $month_13th_30;

    public $manila_salary_15;
    public $manila_salary_30;
    public $manila_allowance_15;
    public $manila_allowance_30;
    public $manila_month_13th_15;
    public $manila_month_13th_30;

    public $date_now;


    public function render()
    {
        return view('livewire.add-payroll');
    }

    public function mount()
    {
        $this->date_now = Carbon::now()->format('Y-m-d');

        $this->payroll_list[] = [
            'name' => $this->name,
            'position' => $this->position,
            'salary_15' => $this->salary_15,
            'salary_30' => $this->salary_30,
            'overtime_15' => $this->overtime_15,
            'overtime_30' => $this->overtime_30,
            'allowance_15' => $this->allowance_15,
            'allowance_30' => $this->allowance_30,
            'month_13th_15' => $this->month_13th_15,
            'month_13th_30' => $this->month_13th_30,
        ];

        $latest = Payroll::latest('created_at')->first();
        if ($latest != null) {
            $latest_array = Payroll::whereDate('created_at', $latest->created_at->toDateString())
                ->get();

            $this->payroll_list = $latest_array->toArray();

            $this->manila_salary_15 = $latest->manila_salary_15;
            $this->manila_salary_30 = $latest->manila_salary_30;
            $this->manila_allowance_15 = $latest->manila_allowance_15;
            $this->manila_allowance_30 = $latest->manila_allowance_30;
            $this->manila_month_13th_15 = $latest->manila_month_13th_15;
            $this->manila_month_13th_30 = $latest->manila_month_13th_30;

            foreach ($this->payroll_list as &$payroll) {
                $payroll['salary_15'] = null;
                $payroll['salary_30'] = null;
                $payroll['overtime_15'] = null;
                $payroll['overtime_30'] = null;
                $payroll['allowance_15'] = null;
                $payroll['allowance_30'] = null;

                unset($payroll['id']);
                unset($payroll['created_at']);
                unset($payroll['updated_at']);
                unset($payroll['month_13th_15']);
                unset($payroll['month_13th_30']);
                unset($payroll['manila_salary_15']);
                unset($payroll['manila_salary_30']);
                unset($payroll['manila_allowance_15']);
                unset($payroll['manila_allowance_30']);
                unset($payroll['manila_month_13th_15']);
                unset($payroll['manila_month_13th_30']);
            }

            unset($payroll);
        }
    }

    public function valOnly()
    {
        $this->validate();
    }

    protected $rules = [
        'manila_salary_15' => 'required',
        'manila_salary_30' => 'required',
        'manila_allowance_15' => 'required',
        'manila_allowance_30' => 'required',
        'manila_month_13th_15' => 'required',
        'manila_month_13th_30' => 'required',
    ];

    public function addButton()
    {
        $this->payroll_list[] = [
            'name' => '',
            'position' => '',
            'salary_15' => '',
            'salary_30' => '',
            'overtime_15' => '',
            'overtime_30' => '',
            'allowance_15' => '',
            'allowance_30' => '',
            'month_13th_15' => '',
            'month_13th_30' => '',
        ];
    }

    public function removeButton($key)
    {
        // unset($this->item_list[$key]);
        array_splice($this->payroll_list, $key, 1);
    }

    public function create()
    {
        // dd($this->payroll_list);
        $this->payroll_list = array_map(function ($payroll) {

            // Update created_at, updated_at
            $payroll['active_status'] = 1;
            $payroll['created_at'] = $this->date_now;
            $payroll['updated_at'] = $this->date_now;

            $payroll['month_13th_15'] = intval($payroll['salary_15']) / 12;
            $payroll['month_13th_30'] = intval($payroll['salary_30']) / 12;

            $payroll['manila_salary_15'] = $this->manila_salary_15;
            $payroll['manila_salary_30'] = $this->manila_salary_30;
            $payroll['manila_allowance_15'] = $this->manila_allowance_15;
            $payroll['manila_allowance_30'] = $this->manila_allowance_30;
            $payroll['manila_month_13th_15'] = $this->manila_month_13th_15;
            $payroll['manila_month_13th_30'] = $this->manila_month_13th_30;
            return $payroll;
        }, $this->payroll_list);
        // dd($this->payroll_list);
        Payroll::insert($this->payroll_list);

        // Loop through each itemre
        foreach ($this->payroll_list as &$payroll) {
            // Log the changes
            $log_entry = [
                'add',
                'payrolls',
                '',
                json_encode($payroll),
            ];
            AC::logEntry($log_entry);
        }

        return redirect('/payrolls')->with('success_message', 'Payroll Has Been Succesfully Created!');
    }
}
