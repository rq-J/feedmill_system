<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PremixesController extends Controller
{
    public function index()
    {
        return view('production_management.premixes');
    }
}
