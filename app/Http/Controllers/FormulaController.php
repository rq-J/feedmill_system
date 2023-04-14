<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Item;
use App\Models\ItemFormula;
use DataTables;

class FormulaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Item::where('active_status', 1)->get();
            $formula = ItemFormula::where('active_status', 1)->get();
            // $existsInModelB = Item::where('id', $itemId)->exists();

            $data = collect();
            if ($items->count() > 0) {
                foreach ($items as $i) {
                    $data->push([
                        'item_name' => $i->item_name,
                        'action' => $existsInModelB = ItemFormula::where('item_id', $i->id)->where('active_status', 1)->exists()  ? '<button id="remove" data-id="' . Crypt::encryptString($i->id) . '" data-name="'  . $i->item_name . '" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>' : '<button id="create" data-id="' . Crypt::encryptString($i->id) . '" data-name="'  . $i->item_name . '" class="btn btn-success btn-sm"><i class="fa-solid fa-plus"></i></button>'
                    ]);
                }
            }

            return DataTables::of($data)
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('production_management.formula');
    }


    function getSimilarItems($array1, $array2, $key1, $key2)
    {
        $similarItems = [];

        foreach ($array1 as $item1) {
            foreach ($array2 as $item2) {
                if ($item1[$key1] === $item2[$key2]) { // Compare key1's value from array1 with key2's value from array2
                    $similarItems[] = $item1[$key1]; // Add to similarItems array if similar
                    break; // Break out of inner loop once similarity is found
                }
            }
        }

        return $similarItems;
    }



    /**
     * Show to be updated
     * @param id
     * @return view and decrypted id
     */
    public function update($id = null)
    {
        $idFormula = Crypt::decryptString($id);

        return view('production_management.formula.update_formula', ['action' => 'Update'])
            ->with('id', $idFormula);
    }
}
