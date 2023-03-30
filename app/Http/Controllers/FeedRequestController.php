<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedRequestController extends Controller
{
    public function index()
    {
        return view('records_inventory.feed_request');
    }
}
