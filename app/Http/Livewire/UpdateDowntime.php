<?php

namespace App\Http\Livewire;

use App\Models\Downtime;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Http\Controllers\AuditController as AC;

class UpdateDowntime extends Component
{
    public $dt, $dt_id, $no, $description, $code;

    public function render()
    {
        return view('livewire.update-downtime');
    }

    public function mount($id)
    {
        $this->dt_id = $id;
        $this->dt = Downtime::findorfail($id);
        [
            $this->no,
            $this->description,
            $this->code
        ] = [
            $this->dt->no,
            $this->dt->description,
            $this->dt->code
        ];
    }

    public function valOnly()
    {
        $this->validate();
    }

    protected $rules = [
        'no' => 'required|string|min:3|max:64',
        'description' => 'required|string|min:3|max:64',
        'code' => 'required|string|min:3|max:64|unique:downtimes,code',
    ];

    public function update()
    {
        if (!$this->validate([
            'code' => [
                'required',
                Rule::unique('downtimes')
                    ->ignore($this->dt_id),
            ]
        ])) {
            return redirect('/pivot/downtime')
                ->with('danger_message', 'Please try again!');
        }


        $to_save = new Downtime();
        $to_save->no = $this->no;
        $to_save->description = $this->description;
        $to_save->code = $this->code;
        $to_save->active_status = 1;

        $to_remove = Downtime::findorfail($this->dt_id);
        $to_remove->active_status = 0;

        if ($to_remove->save() && $to_save->save()) {
            $log_entry = [
                'update',
                'downtimes',
                '',
                json_encode($to_save),

            ];
            AC::logEntry($log_entry);

            $log_entry_to_remove = [
                'update',
                '',
                'downtimes',
                json_encode($to_remove),

            ];
            AC::logEntry($log_entry_to_remove);
            return redirect('/pivot/downtime')
                ->with('success_message', 'Downtime Has Been Succesfully Updated!');
        } else {
            return redirect('/pivot/downtime')
                ->with('danger_message', 'Error in Database!');
        }
    }
}
