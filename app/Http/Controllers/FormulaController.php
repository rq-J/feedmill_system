<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormulaController extends Controller
{
    public function index()
    {
        return view('production_management.formula');
    }
}
