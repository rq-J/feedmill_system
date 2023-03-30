<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountingBillsController extends Controller
{
    public function index()
    {
        return view('reports.accounting_bills');
    }
}
