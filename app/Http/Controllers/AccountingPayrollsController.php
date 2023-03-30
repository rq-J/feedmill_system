<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountingPayrollsController extends Controller
{

    public function index()
    {
        return view('reports.accounting_payrolls');
    }
}
