<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryLevelsController extends Controller
{
    public function index()
    {
        return view('forcasting.inventory_levels');
    }
}
