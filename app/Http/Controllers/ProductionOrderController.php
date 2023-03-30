<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductionOrderController extends Controller
{
    public function index()
    {
        return view('production_management.production_order');
    }
}
