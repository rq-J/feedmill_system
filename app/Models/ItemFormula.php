<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemFormula extends Model
{
    use HasFactory;

    public function item()
    {
    	return $this->belongsTo('App\Models\Item');
    }
    public function raw_material()
    {
    	return $this->belongsTo('App\Models\RawMaterial');
    }
}
