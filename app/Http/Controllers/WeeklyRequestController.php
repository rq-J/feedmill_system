<?php

namespace App\Http\Controllers;

use App\Models\WeeklyRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeeklyRequestController extends Controller
{
    public function index()
    {
        $today = Carbon::now();
        // $week = 18; // week number you want to filter by
        $last_week_start = Carbon::now()->subWeek()->startOfWeek();
        $last_week_end = Carbon::now()->subWeek()->endOfWeek();
        $this_week_start = Carbon::now()->startOfWeek();
        $this_week_end = Carbon::now()->endOfWeek();
        $thursday4pm = Carbon::parse(now()->year . '-W' . now()->week . '-4 16:00:00');

        // dd($last_week_start, $last_week_end);
        $weekly_request_last_week = WeeklyRequest::where('active_status', 1)
            ->where('created_at', '>=', $last_week_start)
            ->where('created_at', '<', $last_week_end)
            ->get();
        $weekly_request_this_week = WeeklyRequest::where('active_status', 1)
            ->where('created_at', '>=', $this_week_start)
            ->where('created_at', '<', $thursday4pm)
            ->get();
        // dd($weekly_request_this_week, $this_week_start, $thursday4pm);
        return view('records_inventory.weekly_request')
            ->with('weekly_request_last_week', $weekly_request_last_week)
            ->with('weekly_request_this_week', $weekly_request_this_week);

    }
}
