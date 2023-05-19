<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyInventory extends Model
{
    use HasFactory;



    public function item_formula()
    {
    	return $this->belongsTo('App\Models\ItemFormula');
    }
}
