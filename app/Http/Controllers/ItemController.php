<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Crypt;
use DataTables;
use App\Http\Controllers\AuditController as AC;


class ItemController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Item::where('active_status', 1)->get();
            $data = collect();
            if ($items->count() > 0) {
                foreach ($items as $i) {
                    $data->push([
                        'item_name' => $i->item_name,
                        'action' => $i->active_status == 1 ? '<button id="update" data-id="' . Crypt::encryptString($i->id) . '" data-name="'  . $i->item_name . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button> <button id="remove" data-id="' . Crypt::encryptString($i->id) . '" data-name="'  . $i->item_name . '" class="btn btn-danger btn-sm"><i class="fa fa-user-lock"></i></button>' : '<button id="enable" data-id="' . Crypt::encryptString($i->id) . '" data-name="'  . $i->item_name . '" class="btn btn-success btn-sm"><i class="fa fa-user-check"></i></button>'
                    ]);
                }
            }

            return DataTables::of($data)
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('production_management.item');
    }
}
