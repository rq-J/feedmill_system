<?php

namespace App\Http\Livewire;

use App\Models\Downtime;
use App\Models\Farm;
use App\Models\FarmLocation;
use App\Models\Item;
use App\Models\ProductionData;
use App\Models\QualityAssurance;
use Carbon\Carbon;
use Livewire\Component;

class AddProductionData extends Component
{

    public $data_list = [];
    public $data;

    // arrays for dropdowns
    public $farms, $items, $quality_assurances, $downtimes;

    // same for every record
    public $date, $target_tons_per_hour, $prod_target_tons, $number_of_manpower;

    // different for every record
    public $item_id, $farm_id, $runtime_start, $runtime_end, $cycle_time, $tons_produced, $tons_per_hour, $quality_assurance_id, $downtime_id, $downtime_start, $downtime_end, $downtime_hour, $total_hours_operated, $remarks;

    public function render()
    {
        return view('livewire.add-production-data');
    }

    public function mount()
    {
        $this->farms = FarmLocation::select('farms.*', 'farm_locations.*')
            ->where('farm_locations.active_status', 1)
            ->join('farms', 'farm_locations.farm_id', '=', 'farms.id')
            ->get();

        $this->items = Item::where('active_status', 1)
            ->get();

        $this->quality_assurances = QualityAssurance::where('active_status', 1)
            ->get();

        $this->downtimes = Downtime::where('active_status', 1)
            ->get();

        // dd($this->downtimes);

        $this->data_list[] = [
            'item_id' => null,
            'farm_id' => null,
            'runtime_start' => null,
            'runtime_end' => null,
            // 'cycle_time' => $this->cycle_time,
            'tons_produced' => null,
            // 'tons_per_hour' => $this->tons_per_hour,
            'quality_assurance_id' => null,
            'downtime_id' => null,
            'downtime_start' => '06:00',
            'downtime_end' => null,
            // 'downtime_hour' => $this->downtime_hour,
            // 'total_hours_operated' => $this->total_hours_operated,
            'remarks' => null
        ];
    }

    protected $rules = [
        'target_tons_per_hour' => '',
        'prod_target_tons' => '',
        'number_of_manpower' => ''
    ];

    public function valOnly()
    {
        $this->validate();
    }

    public function addButton()
    {
        // dd(end($this->data_list)['downtime_end']);
        $this->data_list[] = [
            'item_id' => null,
            'farm_id' => null,
            'runtime_start' => end($this->data_list)['downtime_end'],
            'runtime_end' => null,
            // 'cycle_time' => null,
            'tons_produced' => null,
            // 'tons_per_hour' => null,
            'quality_assurance_id' => null,
            'downtime_id' => null,
            'downtime_start' => null,
            'downtime_end' => null,
            // 'downtime_hour' => null,
            // 'total_hours_operated' => null,
            'remarks' => null
        ];
    }

    public function removeButton($key)
    {
        array_splice($this->data_list, $key, 1);
    }

    public function create()
    {
        $this->data_list = array_map(function ($data) {
            $today = Carbon::today();

            // Update location_id, created_at, updated_at and active_status to 1

            $data['target_tons_per_hour'] = $this->target_tons_per_hour;
            $data['production_target_tons'] = $this->prod_target_tons;
            $data['number_of_manpower'] = $this->number_of_manpower;

            $data['cycle_time'] = $data['runtime_start'] == '' || $data['runtime_end'] == '' ? null : round(((strtotime($data['runtime_end']) - strtotime($data['runtime_start'])) / 60) / 60, 2);

            $data['downtime_hour'] = $data['downtime_start'] == '' || $data['downtime_end'] == '' ? null : round(((strtotime($data['downtime_end']) - strtotime($data['downtime_start'])) / 60) / 60, 2);

            $data['tons_per_hour'] = $data['tons_produced'] == '' || $data['cycle_time'] == '' ? null : round(floatval($data['tons_produced']) / floatval($data['cycle_time']), 2);

            $data['created_at'] = $today;
            $data['updated_at'] = $today;
            $data['active_status'] = 1;
            return $data;
        }, $this->data_list);
        // dd($this->data_list);

        ProductionData::insert($this->data_list);

         // Loop through each itemre
        //  foreach ($this->data_list as &$item) {
        //     // Log the changes
        //     $log_entry = [
        //         'add',
        //         'production_data',
        //         '',
        //         json_encode($item),
        //     ];
        //     AC::logEntry($log_entry);
        // }

    }
}
