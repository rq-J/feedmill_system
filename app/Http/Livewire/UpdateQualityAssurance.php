<?php

namespace App\Http\Livewire;

use App\Models\QualityAssurance;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Http\Controllers\AuditController as AC;

class UpdateQualityAssurance extends Component
{
    public $qa, $qa_id, $description, $code;

    public function render()
    {
        return view('livewire.update-quality-assurance');
    }

    public function mount($id)
    {
        $this->qa_id = $id;
        $this->qa = QualityAssurance::findorfail($id);
        [
            $this->description,
            $this->code
        ] = [
            $this->qa->description,
            $this->qa->code
        ];
    }

    public function valOnly()
    {
        $this->validate();
    }

    protected $rules = [
        'description' => 'required|string|min:3|max:64|unique:quality_assurances,description',
        'code' => 'required|string|min:3|max:64|unique:quality_assurances,code',
    ];

    public function update()
    {
        if (!$this->validate([
            'code' => [
                'required',
                Rule::unique('quality_assurance')
                   ->ignore($this->qa_id),
            ]
        ])) {
            return redirect('/pivot/quality_assurance')
                ->with('danger_message', 'Please try again!');
        }

        $to_save = new QualityAssurance();
        $to_save->description = $this->description;
        $to_save->code = $this->code;
        $to_save->active_status = 1;

        $to_remove = QualityAssurance::findorfail($this->qa_id);
        $to_remove->active_status = 0;

        if ($to_remove->save() && $to_save->save()) {
            $log_entry = [
                'update',
                'quality_assurances',
                '',
                json_encode($to_save),

            ];
            AC::logEntry($log_entry);

            $log_entry_to_remove = [
                'update',
                '',
                'quality_assurances',
                json_encode($to_remove),

            ];
            AC::logEntry($log_entry_to_remove);
            return redirect('/pivot/quality_assurance')
                ->with('success_message', 'Quality Assurance Has Been Succesfully Updated!');
        } else {
            return redirect('/pivot/quality_assurance')
                ->with('danger_message', 'Error in Database!');
        }
    }
}
