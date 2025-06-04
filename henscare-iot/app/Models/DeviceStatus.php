<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceStatus extends Model
{
    protected $fillable = [
        'mode',         // manual atau otomatis
        'lampu',        // true/false
        'kipas',        // true/false
        'kran',         // true/false
        'motor_arah'
    ];

    public $timestamps = false;
}