<?php

namespace App\Http\Livewire;

use App\Http\Controllers\AuditController as AC;
use App\Models\Payroll;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Maatwebsite\Excel\Concerns\ToArray;
use Throwable;

class ViewPayroll extends Component
{
    public $latest;
    public $payroll_list = [];
    public $payrolls;
    public $payroll_date;
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


    public function render()
    {
        return view('livewire.view-payroll');
    }

    public function mount($id)
    {
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
        // dd($latest, date($startOfMonth), date($endOfMonth));
        $latest_array = Payroll::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->where('active_status', 1)
            ->whereDate('created_at', $latest->created_at->toDateString())
            ->get();
        // dd($latest_array, date($startOfMonth), date($endOfMonth));


        $this->latest = $latest_array;

        $this->payroll_list = $latest_array->toArray();

        $this->manila_salary_15 = $latest->manila_salary_15;
        $this->manila_salary_30 = $latest->manila_salary_30;
        $this->manila_allowance_15 = $latest->manila_allowance_15;
        $this->manila_allowance_30 = $latest->manila_allowance_30;
        $this->manila_month_13th_15 = $latest->manila_month_13th_15;
        $this->manila_month_13th_30 = $latest->manila_month_13th_30;

        $this->payroll_date = $latest->created_at->format('Y-m-d');

        foreach ($this->payroll_list as &$payroll) {

            unset($payroll['id']);
            unset($payroll['created_at']);
            unset($payroll['updated_at']);
            unset($payroll['manila_salary_15']);
            unset($payroll['manila_salary_30']);
            unset($payroll['manila_allowance_15']);
            unset($payroll['manila_allowance_30']);
            unset($payroll['manila_month_13th_15']);
            unset($payroll['manila_month_13th_30']);
        }

        unset($payroll);
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

    public function update()
    {
        try {
            // [x]: foreach every record and active_status = 0
            foreach ($this->latest as $record) {
                if ($record->active_status == 1) {
                    $to_remove = Payroll::findorfail($record->id);
                    $to_remove->active_status = 0;
                    $to_remove->save();

                    $log_entry = [
                        'update',
                        '',
                        'payrolls',
                        json_encode($to_remove),

                    ];
                    AC::logEntry($log_entry);
                }
            }

            $today = Carbon::today();

            $this->payroll_list = array_map(function ($payroll) use ($today) {
                // Update created_at, updated_at
                $payroll['created_at'] = $this->payroll_date;
                $payroll['updated_at'] = $today;

                $payroll['active_status'] = 1;

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

            //[x]: go to weekly request again
            return redirect('/payrolls')->with('success_message', 'Payroll Has Been Succesfully Updated!');
        } catch (Exception $exception) {
            DB::rollback();
            return dd($exception);
        } catch (Throwable $throwable) {
            DB::rollback();
            return dd($throwable);
        }
    }
}
