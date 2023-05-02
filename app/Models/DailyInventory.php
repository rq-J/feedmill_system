<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'actual_count_bags',
        'actual_count_kgs',
        'actual_count_total',
        'actual_count_diff'
    ];

    public function item_formula()
    {
    	return $this->belongsTo('App\Models\ItemFormula');
    }
}
