<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;

    protected $fillable = ['raw_material_name', 'standard_days', 'category'];

    public function item_formula()
    {
        return $this->hasMany(ItemFormula::class);
    }
}
