<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'deviceType_id',
        'serial_number',
        'model',
        'hours_lastServ',
        'actual_hours',
        'update_actualHours',
        'last_visit',
        'visit_type',
        'prox_service',
        'photo'
    ];

    public function type()
    {
        return $this->belongsTo(DeviceType::class, 'deviceType_id');
    }
}
