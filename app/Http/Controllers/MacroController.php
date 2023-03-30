<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MacroController extends Controller
{
    public function index()
    {
        return view('ingredient_storage.macro');
    }
}
