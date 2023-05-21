<?php

namespace App\Http\Livewire;

use App\Models\Downtime;
use Livewire\Component;
use App\Http\Controllers\AuditController as AC;

class AddDowntime extends Component
{
    public $no, $description, $code;

    public function render()
    {
        return view('livewire.add-downtime');
    }

    public function valOnly()
    {
        $this->validate();
    }

    protected $rules = [
        'no' => 'required|string|min:2|max:64|unique:downtimes,no',
        'description' => 'required|string|min:3|max:64|unique:downtimes,description',
        'code' => 'required|string|min:3|max:64|unique:downtimes,code',
    ];

    public function test_similarity_code($test_val)
    {
        $gat_all = Downtime::where('active_status', 1)->pluck('code');
        $test_val_upper = strtoupper($test_val);

        foreach ($gat_all as $name) {
            if (similar_text($test_val_upper, strtoupper($name)) > 99) {
                return true;
            }
        }

        return false;
    }

    public function test_similarity_no($test_val)
    {
        $gat_all = Downtime::where('active_status', 1)->pluck('no');
        $test_val_upper = strtoupper($test_val);

        foreach ($gat_all as $name) {
            if (similar_text($test_val_upper, strtoupper($name)) > 99) {
                return true;
            }
        }

        return false;
    }

    public function create()
    {
        if (!$this->validate()) {
            return;
        }

        if ($this->test_similarity_no($this->no)) {
            return redirect('/pivot/quality_assurance')
                ->with(
                    'danger_message',
                    'Invalid Input, Duplicate "NO" Found!'
                );
        }

        if ($this->test_similarity_code($this->code)) {
            return redirect('/pivot/quality_assurance')
                ->with(
                    'danger_message',
                    'Invalid Input, Duplicate Code Found!'
                );
        }

        $dt = Downtime::create([
            'no' => strtoupper($this->no),
            'description' => strtoupper($this->description),
            'code' => strtoupper($this->code),
            'active_status' => 1,
        ]);

        // [action, table, old_value, new_value]
        $log_entry = [
            'new',
            'downtimes',
            '',
            $dt,
        ];
        AC::logEntry($log_entry);

        return redirect('/pivot/downtime')
            ->with(
                'success_message',
                strtoupper($this->no) . ' has been Successfully Created!'
            );
    }
}
