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
                        'action' => $i->active_status == 1 ? '<button id="remove" data-id="' . Crypt::encryptString($i->id) . '" data-name="'  . $i->item_name . '" class="btn btn-danger btn-sm"><i class="fa fa-user-lock"></i></button>' : '<button id="enable" data-id="' . Crypt::encryptString($i->id) . '" data-name="'  . $i->item_name . '" class="btn btn-success btn-sm"><i class="fa fa-user-check"></i></button>'
                    ]);
                }
            }

            return DataTables::of($data)
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('production_management.item');
    }

    /**
     * Show to be updated
     * @param id
     * @return view and decrypted id
     */
    public function update($id = null)
    {
        $id_item = Crypt::decryptString($id);

        // [ ]: remove the update, NO UPDATE!
        return view('production_management.item.update_item', ['action' => 'Update'])
            ->with('id', $id_item);
    }

    /**
     * To remove a record(active status = o)
     * @param id
     * @return null
     */
    // [ ]: update the "remove", the function is only for item (missing - formula)
    public function remove($id = null)
    {
        try {
            $id = Crypt::decryptString($id);
        } catch (\Throwable $e) {
            return $e;
        }

        $item = Item::findorfail($id);
        $item_old = $item;
        $item->active_status = 0;
        if ($item->save()) {

            // [action, table, old_value, new_value]
            $log_entry = [
                'remove item',
                'items',
                $item_old,
                '',
            ];
            AC::logEntry($log_entry);

            return redirect('/item')
                ->with('success_message', 'Task Has Been Succesfully Deleted!');
        }
        return redirect('/item')
            ->with('danger_message', 'Error in Database!');
    }
}
