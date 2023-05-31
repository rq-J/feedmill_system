<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductionData extends Model
{
    use HasFactory;

    public $fillable = [
        'item_id', 'farm_id', 'runtime_start', 'runtime_end', 'cycle_time', 'tons_produced', 'tons_per_hour', 'quality_assurance_id', 'downtime_id', 'downtime_start', 'downtime_end', 'downtime_hour', 'total_hours_operated', 'remarks'
    ];
}
