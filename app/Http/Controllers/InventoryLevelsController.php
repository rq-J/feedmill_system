<?php

namespace App\Http\Controllers;

use App\Models\DailyInventory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class InventoryLevelsController extends Controller
{
    public function index(Request $request)
    {
        $today_start = Carbon::now()->startOfDay()->format('Y-m-d H:i:s');
        $today_end = Carbon::now()->endOfDay()->format('Y-m-d H:i:s');

        // $inventory_levels = DailyInventory::select('daily_inventories.raw_material_id', 'daily_inventories.number_of_days')
        //     ->whereDate('updated_at', '>=', $today_start)
        //     ->whereDate('updated_at', '<=', $today_end)
        //     ->get();
        // dd($inventory_levels, $today_start, $today_end);


        if ($request->ajax()) {
            $inventory_levels = DailyInventory::select('daily_inventories.raw_material_id', 'daily_inventories.number_of_days')
            ->whereDate('updated_at', '>=', $today_start)
            ->whereDate('updated_at', '<=', $today_end)
            ->get();

            $data = collect();
            if ($inventory_levels->count() > 0) {
                foreach ($inventory_levels as $i) {
                    $data->push([
                        // 'id' => $i->id,
                        'raw_material' => $i->raw_material->raw_material_name,
                        'inventory_level' => $i->number_of_days,
                        // 'view' => '<button class="btn btn-success btn-sm">VIEW</button>'
                    ]);
                }
            }
            return DataTables::of($data)
                ->rawColumns(['view'])
                ->make(true);
        }
        return view('forcasting.inventory_levels');
    }
}
