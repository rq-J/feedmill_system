<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageSlackController extends Controller
{
    public function index()
    {
        return view('forcasting.message_slack');
    }
}
