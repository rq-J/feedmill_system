<?php

namespace App\Http\Livewire;

use App\Models\FarmLocation;
use App\Models\Item;
use App\Models\WeeklyRequest;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuditController as AC;

class UpdateWeeklyRequest extends Component
{
    public $request_id;
    public $request;
    public $locations;
    public $items;

    public $selectedLocation;
    public $selectedItem;

    public $farm_location_id;
    public $item_id;
    public $age_or_stage;
    public $population;
    public $grams_per_population;
    public $total_request;

    public function render()
    {
        return view('livewire.update-weekly-request');
    }

    public function mount($id)
    {
        $this->locations = FarmLocation::select('farms.*', 'farm_locations.*')
            ->where('farm_locations.active_status', 1)
            ->join('farms', 'farm_locations.farm_id', '=', 'farms.id')
            ->get();

        $this->items = Item::where('active_status', 1)
            ->get();


        $this->request_id = $id;
        $this->request = WeeklyRequest::findorfail($id);
        [
            $this->selectedLocation,
            $this->selectedItem,
            $this->age_or_stage,
            $this->population,
            $this->grams_per_population,
            $this->total_request
        ] = [
            $this->request->farm_location_id,
            $this->request->item_id,
            $this->request->age_or_stage,
            $this->request->population,
            $this->request->grams_per_population,
            $this->request->total_request
        ];
    }

    public function valOnly()
    {
        $this->validate();
    }

    protected $rules = [
        'age_or_stage' => 'required|numeric|min:1',
        'population' => 'required|numeric|min:1',
        'grams_per_population' => 'required|numeric|min:1',
        'total_request' => 'required|numeric|min:1',
    ];

    public function update()
    {
        // dd('update');
        $new_request = new WeeklyRequest();
        $new_request->user_id = Auth::user()->id;
        $new_request->farm_location_id = $this->selectedLocation;
        $new_request->item_id = $this->selectedItem;
        $new_request->age_or_stage = $this->age_or_stage;
        $new_request->population = $this->population;
        $new_request->grams_per_population = $this->grams_per_population;
        $new_request->total_request = $this->total_request;
        $new_request->active_status = 1;

        $to_remove = WeeklyRequest::findorfail($this->request_id);
        $to_remove->active_status = 0;

        if ($to_remove->save() && $new_request->save()) {
            // [x]: audit logs?

            $log_entry = [
                'update',
                'raw_materials',
                '',
                json_encode($new_request),

            ];
            AC::logEntry($log_entry);

            $log_entry = [
                'update',
                '',
                'raw_materials',
                json_encode($to_remove),

            ];
            AC::logEntry($log_entry);

            return redirect('/request')->with('success_message', 'Daily Monitoring Has Been Succesfully Updated!');
        } else {
            return redirect('/request')->with('danger_message', 'Error in Database!');
        }
    }

}
