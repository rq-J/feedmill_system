<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Models\RawMaterial;

class ContentController extends Controller
{
    // public function dash()
    // {
    // 	return view('dash');
    // }

    public function macro()
    {
        return view('ingredient_storage.macro');
    }

    public function micro()
    {
        return view('ingredient_storage.micro');
    }

    public function medicine()
    {
        return view('ingredient_storage.medicine');
    }

    public function feed_request()
    {
        return view('records_inventory.feed_request');
    }

    public function farm_information()
    {
        return view('records_inventory.farm_information');
    }

    public function inventory_levels()
    {
        return view('forcasting.inventory_levels');
    }

    public function message_slack()
    {
        return view('forcasting.message_slack');
    }

    public function production_order()
    {
        return view('production_management.production_order');
    }

    public function premixes()
    {
        return view('production_management.premixes');
    }

    public function raw_materials()
    {
        $raw_material_data = RawMaterial::where("active_status", 1)->get();
        return view('production_management.raw_material')->with('raw_materials',$raw_material_data);
    }

    public function accounting_bills()
    {
        return view('reports.accounting_bills');
    }

    public function accounting_payrolls()
    {
        return view('reports.accounting_payrolls');
    }

    public function audit_logs()
    {
        return view('reports.audit_logs');
    }

    public function pivot_logs()
    {
        return view('reports.pivot_logs');
    }

    public function accounts()
    {
        return view('users.accounts');
    }

    public function permissions()
    {
        return view('users.permissions');
    }
}
