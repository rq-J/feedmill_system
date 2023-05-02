<?php

namespace App\Http\Controllers;

use App\Models\DailyInventory;
use App\Models\ItemDaily;
use App\Models\ItemDailyInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ItemDailyController extends Controller
{
    //


    public function index()
    {
        $currentDate = Carbon::today();
        $yesterdayDate = Carbon::yesterday();

        // will check if there is already recorded item_dailies
        $item_daily = ItemDaily::whereDate('created_at', $currentDate)->first();
        // will check if there is recorded daily inventory yesterday
        $daily_inventory_today = DailyInventory::whereDate('created_at', $currentDate)->first();
        $daily_inventory = DailyInventory::whereDate('created_at', $yesterdayDate)->first();

        // if there is record of $item_daily, the will go straight to daily inventory
        // else go to daily inventory
        if ($daily_inventory_today && $item_daily) {
            // show nothing if has record for today, both
            $result = 'complete';
            dd($daily_inventory_today && $item_daily);
        } else if ($item_daily) {
            // show daily_inventory if there is already $item_daily record
            $result = 'daily_inventory';
        } else {
            $result = 'item_daily';
        }


        return view('ingredient_storage.item_daily')
            ->with('result', $result);
    }
}
