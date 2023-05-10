<?php

namespace App\Http\Livewire;

use App\Models\WeeklyRequest;
use Livewire\Component;
use PhpParser\Node\Expr\FuncCall;

class UpdateDailyMonitoring extends Component
{
    public $request_id;
    public $request;

    public $selectedLocation;
    public $selectedItem;

    public $farm_location_id;
    public $item_id;
    public $age_or_stage;
    public $population;
    public $grams_per_population;
    public $total_request;
    public $monday;
    public $tuesday;
    public $wenesday;
    public $thursday;
    public $friday;
    public $saturday;

    public function render()
    {
        // dd($this->request);
        return view('livewire.update-daily-monitoring');
    }

    public function mount($id)
    {
        $this->request_id = $id;
        $this->request = WeeklyRequest::select('farm_locations.farm_location', 'items.item_name', 'weekly_requests.*')
            ->join('items', 'weekly_requests.item_id', '=', 'items.id')
            ->join('farm_locations', 'weekly_requests.farm_location_id', '=', 'farm_locations.id')
            ->findorfail($id);

        [
            $this->selectedLocation,
            $this->selectedItem,
            $this->age_or_stage,
            $this->population,
            $this->grams_per_population,
            $this->total_request,
            $this->monday,
            $this->tuesday,
            $this->wenesday,
            $this->thursday,
            $this->friday,
            $this->saturday,
        ] = [
            $this->request->farm_location,
            $this->request->item_name,
            $this->request->age_or_stage,
            $this->request->population,
            $this->request->grams_per_population,
            $this->request->total_request,
            $this->request->monday,
            $this->request->tuesday,
            $this->request->wenesday,
            $this->request->thursday,
            $this->request->friday,
            $this->request->saturday,
        ];
    }

    public function valOnly()
    {
        $this->validate();
    }

    protected $rules = [
        'monday'   => 'required|numeric|min:0',
        'tuesday'  => 'required|numeric|min:0',
        'wenesday' => 'required|numeric|min:0',
        'thursday' => 'required|numeric|min:0',
        'friday'   => 'required|numeric|min:0',
        'saturday' => 'required|numeric|min:0',
    ];

    public function update()
    {
        // dd('update');

        $to_update = WeeklyRequest::findorfail($this->request_id);
        $to_update->monday   = $this->monday;
        $to_update->tuesday  = $this->tuesday;
        $to_update->wenesday = $this->wenesday;
        $to_update->thursday = $this->thursday;
        $to_update->friday   = $this->friday;
        $to_update->saturday = $this->saturday;


        if ($to_update->save()) {
            // [ ]: audit logs?
            return redirect('/request')->with('success_message', 'Weekly Request Has Been Succesfully Updated!');
        } else {
            return redirect('/request')->with('danger_message', 'Error in Database!');
        }
    }
}
