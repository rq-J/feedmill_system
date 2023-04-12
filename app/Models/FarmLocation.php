<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmLocation extends Model
{
    use HasFactory;

    protected $fillable = ['farm_location', 'farm_name'];

    public function farm()
    {
    	return $this->belongsTo('App\Models\Farm');
    }
}
