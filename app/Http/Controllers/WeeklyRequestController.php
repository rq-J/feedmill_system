<?php

namespace App\Http\Controllers;

use App\Models\WeeklyRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\AuditController as AC;

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
        // [ ]: all user can see each other request?
        $weekly_request_last_week = WeeklyRequest::select('farm_locations.farm_location', 'items.item_name', 'weekly_requests.*')
            ->where('weekly_requests.active_status', 1)
            ->join('farm_locations', 'weekly_requests.farm_location_id', '=', 'farm_locations.id')
            ->join('items', 'weekly_requests.item_id', '=', 'items.id')
            ->where('weekly_requests.created_at', '>=', $last_week_start)
            ->where('weekly_requests.created_at', '<', $last_week_end)
            ->get();
        $weekly_request_this_week = WeeklyRequest::select('farm_locations.farm_location', 'items.item_name', 'weekly_requests.*')
            ->where('weekly_requests.active_status', 1)
            ->join('farm_locations', 'weekly_requests.farm_location_id', '=', 'farm_locations.id')
            ->join('items', 'weekly_requests.item_id', '=', 'items.id')
            ->where('weekly_requests.created_at', '>=', $this_week_start)
            ->where('weekly_requests.created_at', '<', $thursday4pm)
            ->get();
        return view('records_inventory.weekly_request')
            ->with('weekly_request_last_week', $weekly_request_last_week)
            ->with('weekly_request_this_week', $weekly_request_this_week);
    }

    public function update($id)
    {
        return view('records_inventory.weekly_request.update_weekly_request')->with('id',Crypt::decryptString($id));
    }

    public function remove($id = null)
    {
        try {
            $id = Crypt::decryptString($id);
        } catch (\Throwable $e) {
            return $e;
        }

        $weekly_request = WeeklyRequest::findorfail($id);
        $weekly_request_old = $weekly_request;
        $weekly_request->active_status = 0;
        if ($weekly_request->save()) {

            // [action, table, old_value, new_value]
            $log_entry = [
                'remove ',
                'weekly_requests',
                $weekly_request_old,
                '',
            ];
            AC::logEntry($log_entry);

            return redirect('/request')
                ->with('success_message', 'Task Has Been Succesfully Deleted!');
        }
        return redirect('/request')
            ->with('danger_message', 'Error in Database!');
    }

    public function monitor($id)
    {
        return view('records_inventory.weekly_request.update_daily_monitoring')->with('id',Crypt::decryptString($id));
    }
}
