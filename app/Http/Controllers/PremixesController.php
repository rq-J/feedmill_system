<?php

namespace App\Http\Controllers;

use App\Models\Premix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DataTables;

class PremixesController extends Controller
{
    public function index(Request $request)
    {
        //DataTable
        // [ ]: can be added with date-filter, in the firefox bookmark
        if ($request->ajax()) {
            // $items = RawMaterial::where('active_status', 1)->get();
            $items = Premix::select('items.item_name', 'premixes.*')
                ->join('items', 'premixes.item_id', '=', 'items.id')
                ->where('items.active_status', 1)
                ->get();
            $data = collect();
            if ($items->count() > 0) {
                foreach ($items as $r) {
                    $data->push([
                        'item_name' => $r->item_name,
                        'beginning' => $r->beginning,
                        'micro' => $r->micro,
                        'macro' => $r->macro,
                        'ending' => $r->ending
                    ]);
                }
            }

            return DataTables::of($data)
            ->make(true);
        }
        // dd($items);

        return view('production_management.premixes');
    }
}
