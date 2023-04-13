<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['item_name'];

    public function item_formula()
    {
        return $this->hasMany(ItemFormula::class);
    }
}
