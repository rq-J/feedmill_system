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
            $commonElements = array_intersect($items, $formula);
            return $commonElements;
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
        $items = (Item::where('active_status', 1)->get())->toArray();
        $formulas = ItemFormula::where('active_status', 1)->get();
        // Convert the array to a collection
        // $formulasCollection = collect($formulas);
        // Loop through each animal and replace farm_id with farm_name
        $arrFormula = $formulas->map(function ($formula) {
            return [
                'item_id' => $formula->item->item_name, // Access the related farm's name
            ];
        })->toArray(); // Convert the collection to an array
        print_r($arrFormula);
        echo "<br>";
        print_r($items);
        echo '</pre>';
        echo "<br>";
        // print_r(array_intersect($this->serialize_array_values($items), $this->serialize_array_values($arrFormula)));
        print_r($this->array_deep_diff($arrFormula, $items));
        // return view('production_management.formula');
    }

    //Low level seach item array
    function serialize_array_values($arr)
    {
        foreach ($arr as $key => $val) {
            sort($val);
            $arr[$key] = serialize($val);
        }

        return $arr;
    }

    //High level search item(sub-array)
    function array_deep_diff($array1, $array2) {
        $diff = array();

        foreach ($array1 as $key => $value1) {
            $value2 = $array2[$key] ?? null;

            if (is_array($value1) && is_array($value2)) {
                $subDiff = $this->array_deep_diff($value1, $value2);

                if (!empty($subDiff)) {
                    $diff[$key] = $subDiff;
                }
            } else if ($value1 !== $value2) {
                $diff[$key] = $value1;
            }
        }

        return $diff;
    }


    /**
     * Show to be updated
     * @param id
     * @return view and decrypted id
     */
    public function update($id = null)
    {
        $idFormula = Crypt::decryptString($id);

        return view('production_management.production_management.update_formula', ['action' => 'Update'])
            ->with('id', $idFormula);
    }
}
