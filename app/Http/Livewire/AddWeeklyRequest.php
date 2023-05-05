<?php

namespace App\Http\Livewire;

use App\Models\Farm;
use App\Models\FarmLocation;
use App\Models\Item;
use Carbon\Carbon;
use Livewire\Component;
use App\Http\Controllers\AuditController as AC;
use App\Models\WeeklyRequest;

class AddWeeklyRequest extends Component
{
    public $farm_location;
    public $selectedLocation = 1;
    public $farm_name;
    public $locations;

    public $item_list = [];
    public $items;
    public $item_id = 1;
    public $age_or_stage;
    public $population;
    public $grams_per_population;
    public $total_request;

    protected $rules = [
        // 'age_or_stage' => 'require',
    ];

    public function render()
    {
        if ($this->locations->count() == 0) {
            //go to the farm
        }
        // dd($this->item_list);
        return view('livewire.add-weekly-request');
    }

    public function mount()
    {
        $this->locations = FarmLocation::select('farms.*', 'farm_locations.*')
            ->where('farm_locations.active_status', 1)
            ->join('farms', 'farm_locations.farm_id', '=', 'farms.id')
            ->get();

        $this->items = Item::where('active_status', 1)
            ->get();

        $this->item_list[] = [
            'item_id' => $this->item_id,
            'age_or_stage' => $this->age_or_stage,
            'population' => $this->population,
            'grams_per_population' => $this->grams_per_population,
            'total_request' => $this->total_request
        ];
    }

    public function categorySelected($data)
    {
        return $this->selectedLocation = $data;
    }

    public function addButton()
    {
        $this->item_list[] = [
            'item_id' => '',
            'age_or_stage' => '',
            'population' => '',
            'grams_per_population' => '',
            'total_request' => ''
        ];
    }

    public function removeButton($key)
    {
        // unset($this->item_list[$key]);
        array_splice($this->item_list, $key, 1);
    }

    public function create()
    {
        $this->item_list = array_map(function ($item) {
            $today = Carbon::today();

            // Update location_id, created_at, updated_at and active_status to 1
            $item['farm_location_id'] = $this->selectedLocation;
            $item['created_at'] = $today;
            $item['updated_at'] = $today;
            $item['active_status'] = 1;
            return $item;
        }, $this->item_list);

        WeeklyRequest::insert($this->item_list);

        // Loop through each item
        foreach ($this->item_list as &$item) {
            // Log the changes
            $log_entry = [
                'add',
                'weekly_requests',
                '',
                json_encode($item),
            ];
            AC::logEntry($log_entry);
        }
    }
}
