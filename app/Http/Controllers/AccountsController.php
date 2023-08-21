<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function index()
    {
        //[ ]: DO THIS FOR ACCOUNTS
        /*
        if users == 0
        {
            log out, suggest db:seed
        }
        */
        return view('users.accounts');
    }
}
