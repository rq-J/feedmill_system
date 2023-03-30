<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MicroController extends Controller
{
    public function index()
    {
        return view('ingredient_storage.micro');
    }
}
