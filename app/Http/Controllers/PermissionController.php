<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        //[ ]: DO THIS FOR PERMISSION
        /*
        if accounts = 0
        {
            log-out
        }
        else
        {
            if user == superuser
            {
                checklist are all checked
            }
            show a check list with the ff:
            Full name
            Dashboard
            Daily Item Entries
            Weekly Request
            Farm Info
            Inventory Levels
            Production Orders
            Production Data
            Premixes
            Item - Formula
            Raw Materials
            Accounting Bills
            Accounting Payrolls
            Pivot Logs
            Permission
        }
        */
        return view('users.permissions');
    }
}
