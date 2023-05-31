<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductionDataController extends Controller
{
    public function index()
    {
        // $this_week_start = Carbon::now()->startOfWeek();
        // $thursday4pm = Carbon::parse(now()->year . '-W' . now()->week . '-4 16:00:00');


        // $weekly_request_this_week = WeeklyRequest::select('farm_locations.farm_location', 'items.item_name', 'weekly_requests.*')
        //     ->where('weekly_requests.active_status', 1)
        //     ->join('farm_locations', 'weekly_requests.farm_location_id', '=', 'farm_locations.id')
        //     ->join('items', 'weekly_requests.item_id', '=', 'items.id')
        //     ->where('weekly_requests.created_at', '>=', $this_week_start)
        //     ->where('weekly_requests.created_at', '<', $thursday4pm)
        //     ->get();

        return view('production_management.production_data');
            // ->with('weekly_request_this_week', $weekly_request_this_week);
    }
}
