<?php

namespace App\Http\Livewire;

use App\Models\QualityAssurance;
use Livewire\Component;
use App\Http\Controllers\AuditController as AC;

class AddQualityAssurance extends Component
{
    public $description, $code;

    public function render()
    {
        return view('livewire.add-quality-assurance');
    }

    public function valOnly()
    {
        $this->validate();
    }

    protected $rules = [
        'description' => 'required|string|min:3|max:64|unique:quality_assurances,description',
        'code' => 'required|string|min:3|max:64|unique:quality_assurances,code',
    ];

    public function test_similarity($test_val)
    {
        $gat_all = QualityAssurance::where('active_status', 1)->pluck('code');
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

        if ($this->test_similarity($this->code)) {
            return redirect('/pivot/quality_assurance')
                ->with(
                    'danger_message',
                    'Invalid Input, Duplicate Code Found!'
                );
        }

        $qa = QualityAssurance::create([
            'description' => strtoupper($this->description),
            'code' => strtoupper($this->code),
            'active_status' => 1,
        ]);

        // [action, table, old_value, new_value]
        $log_entry = [
            'new',
            'quality_assurances',
            '',
            $qa,
        ];
        AC::logEntry($log_entry);

        return redirect('/pivot/quality_assurance')
            ->with(
                'success_message',
                strtoupper($this->code) . ' has been Successfully Created!'
            );
    }
}
