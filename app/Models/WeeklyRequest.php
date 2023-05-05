<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'monday',
        'tuesday',
        'wenesday',
        'thurday',
        'friday',
        'saturday'
    ];

    public function location()
    {
    	return $this->belongsTo('App\Models\FarmLocation');
    }

    public function item()
    {
    	return $this->belongsTo('App\Models\Item');
    }
}
