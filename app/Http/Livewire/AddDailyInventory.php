<?php

namespace App\Http\Livewire;

use App\Models\DailyInventory;
use Livewire\Component;
use App\Models\RawMaterial;
use App\Http\Controllers\AuditController as AC;
use App\Models\ItemDaily;
use Carbon\Carbon;
use Exception;
use PHPUnit\Event\Code\Test;

class AddDailyInventory extends Component
{
    public $arrMacro = [];
    public $arrMicro = [];
    public $arrMedicine = [];

    public $unique_item_ids = [];
    public $unique_farm_ids = [];
    public $item_ids = [];

    public $tableData = [];

    protected $listeners = ['saveData' => 'create'];

    public function render()
    {
        // dd($this->item_dailies);
        return view('livewire.add-daily-inventory');
    }

    public function mount()
    {
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();

        $this->arrMacro = RawMaterial::select('raw_materials.*')
            ->where('active_status', 1)
            ->where('category', 'MACRO')
            ->get();
        $this->arrMicro = RawMaterial::select('raw_materials.*')
            ->where('active_status', 1)
            ->where('category', 'MICRO')
            ->get();
        $this->arrMedicine = RawMaterial::select('raw_materials.*')
            ->where('active_status', 1)
            ->where('category', 'MEDICINE')
            ->get();
    }

    public function create($from_blade)
    {
        $macro = $from_blade[0];
        $micro = $from_blade[1];
        $medicine = $from_blade[2];

        if (
            $this->validateArray($macro) ||
            $this->validateArrayWithActual($micro) ||
            $this->validateArrayWithActual($medicine)
        ) {
            try {
                // dd($macro, $micro, $medicine);

                // [ ]: apply to micro and medicine
                $this->pushToDatabase($this->withComputations($macro));
                $this->pushToDatabase($this->withComputations($micro));
                $this->pushToDatabase($this->withComputations($medicine));
            } catch (Exception $exception) {
            }
        }
    }

    public function validateArray(array $data)
    {
        $valid = true;
        foreach ($data as $row) {
            foreach ($data as $row) {
                if (!is_numeric($row['price_per_kgs']) || !is_numeric($row['inventory_cost']) || !is_numeric($row['kgs_per_bag']) || !is_numeric($row['deliveries_today'])) {
                    $valid = false;
                    break 2;
                }
            }
        }
        return $valid;
    }

    public function validateArrayWithActual(array $data)
    {
        $valid = true;
        foreach ($data as $row) {
            foreach ($data as $row) {
                if (
                    !is_numeric($row['price_per_kgs']) ||
                    !is_numeric($row['inventory_cost']) ||
                    !is_numeric($row['kgs_per_bag']) ||
                    !is_numeric($row['deliveries_today'])
                    || !is_numeric($row['actual_count_bags']) ||
                    !is_numeric($row['actual_count_kgs'])
                ) {
                    $valid = false;
                    break 2;
                }
            }
        }
        return $valid;
    }

    public function pushToDatabase(array $data)
    {
        $data = array_map(function ($item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
            return $item;
        }, $data);

        dd($data);
        $this->tableData = $data;
        DailyInventory::insert($data);

        // Loop through each item_daily
        foreach ($this->tableData as &$item_daily) {
            // Update active_status to 0
            $item_daily['active_status'] = 1;

            // Log the changes
            $log_entry = [
                'add item_daily',
                'item_daily',
                '',
                json_encode($item_daily),

            ];
            AC::logEntry($log_entry);
        }
    }

    public function withComputations($rawMaterialArray)
    {
        $yesterday = Carbon::yesterday();
        $today = Carbon::today();

        // Initialize empty array to hold results
        $results = array();
        $item_dailies = ItemDaily::select('item_formulas.*', 'raw_materials.*', 'item_dailies.*')
            ->whereDate('item_dailies.created_at', $today)
            ->join('item_formulas', 'item_dailies.item_formula_id', '=', 'item_formulas.id')
            ->where('item_formulas.active_status', 1)
            ->join('raw_materials', 'item_formulas.raw_material_id', '=', 'raw_materials.id')
            ->where('raw_materials.active_status', 1)
            ->get(); // get all usage of each raw_material = usage today in daily inventory
        // [x]: filter the raw_material_id and get the total usage and return the grand_total

        //get data from yesterday
        $daily_inventory = DailyInventory::select('daily_inventories.*')
            ->whereDate('created_at', $yesterday)
            ->get();
        // [ ]: function to filter out the raw_material_id and return end_inv_kgs, delivery(todate), usage(todate),
        // dd($item_dailies);

        // Loop through the first array
        foreach ($rawMaterialArray as $macro) {
            // dd($macro, $item_dailies);
            // Initialize variables to hold category and macro id
            $raw_material_id = $macro['id'];
            $grand_total = $this->getGrandTotal($raw_material_id, $item_dailies);
            $multiple_data = $this->getMultipleData($raw_material_id, $daily_inventory);
            // dd($multiple_data[0]);


            // dd($this->getGrandTotal($raw_material_id, $item_dailies));

            // Initialize variables to hold item_formula_id, batch, total batch, and adjustment

            $price_per_kgs = $macro['price_per_kgs'];
            $inventory_cost = $macro['inventory_cost'];
            $kgs_per_bag = $macro['kgs_per_bag'];
            $begin_inventory_kgs = floatval($multiple_data[0]['end_inv_kgs']); // end_inventory_kgs yesterday
            $deliveries_today = $macro['deliveries_today'];
            // dd($deliveries_today, floatval($multiple_data[0]['usage(todate)']));
            $deliveries_todate = floatval($deliveries_today) + floatval($multiple_data[0]['usage(todate)']); // + todate yesterday
            // dd('test');
            $usage_today = $grand_total[0];
            $usage_todate = $usage_today + floatval($multiple_data[0]['usage(todate)']); //+ usage todate yesterday
            $end_inventory_kgs = $begin_inventory_kgs + $usage_today;
            $end_inventory_bags = $end_inventory_kgs / $kgs_per_bag;
            $numbers_of_working = $macro['number_of_working_days'];
            $average_usage = $numbers_of_working != 0 ?  $usage_todate / $numbers_of_working : 0;
            $number_of_days = $average_usage != 0 ? $end_inventory_kgs / $average_usage : 0;
            $actual_count_bags = isset($macro['actual_count_bags']) ? $macro['actual_count_bags'] : null;
            $actual_count_kgs = isset($macro['actual_count_kgs']) ? $macro['actual_count_kgs'] : null;
            $actual_count_total = $kgs_per_bag * $actual_count_bags + $actual_count_kgs;
            $actual_count_diff = $actual_count_total != 0 ? $end_inventory_kgs / $actual_count_total : 0;
            //created_at

            // Push the category-by-item with batch, total batch, adjustment, and usage to the results array
            array_push($results, array(
                'id' => $raw_material_id,
                'price_per_kgs' => $price_per_kgs,
                'inventory_cost' => $inventory_cost,
                'kgs_per_bag' => $kgs_per_bag,
                'begin_inventory_kgs' => $begin_inventory_kgs,
                'deliveries_today' => $deliveries_today,
                'deliveries_todate' => $deliveries_todate,
                'usage_today' => $usage_today,
                'usage_todate' => $usage_todate,
                'end_inventory_kgs' => $end_inventory_kgs,
                'end_inventory_bags' => $end_inventory_bags,
                'numbers_of_working' => $numbers_of_working,
                'average_usage' => $average_usage,
                'number_of_days' => $number_of_days,
                'actual_count_bags' => $actual_count_bags,
                'actual_count_kgs' => $actual_count_kgs,
                'actual_count_total' => $actual_count_total,
                'actual_count_diff' => $actual_count_diff
            ));
        }

        // Return the results array
        return $results;
        // print_r($results);
        // dd($results);
    }

    function getGrandTotal($raw_material_id, $data)
    {
        $total_usage = $data->where('raw_material_id', $raw_material_id)->sum('usage');
        $grand_total = $data->sum('usage');
        // return [$total_usage, $grand_total];
        return [$grand_total];
    }

    function getMultipleData($raw_material_id, $data)
    {
        $result = array();
        // dd($data);
        // Loop through each raw material id and filter the daily inventory array for that id
        foreach ($data as $data_item) {
            $end_inv_kgs_total = 0;
            $delivery_todate_total = 0;
            $usage_todate_total = 0;

            // $filtered_data = array_filter($data_item, function ($item) use ($data_item) {
            //     return $item['raw_material_id'] == $data_item;
            // });
            $filtered_data = $data->where('raw_material_id', $raw_material_id);
            // dd($filtered_data);

            // Sum the end inventory, delivery to date, and usage to date columns from the filtered data
            foreach ($filtered_data as $item) {
                $end_inv_kgs_total = isset($item['end_inventory_kgs']) ? $item['end_inventory_kgs'] : 0;
                $delivery_todate_total = isset($item['deliveries_today']) ?  $item['deliveries_today'] : 0;
                $usage_todate_total = isset($item['usage_todate']) ? $item['usage_todate'] : 0;
            }

            // Add the totals to the result array for the current raw material id
            $result[0] = array(
                'end_inv_kgs' => $end_inv_kgs_total,
                'delivery(todate)' => $delivery_todate_total,
                'usage(todate)' => $usage_todate_total,
            );
            // dd($usage_todate_total);
        }

        // Return the results as an array
        // dd($result);
        return $result;
    }
}
