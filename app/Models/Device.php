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
        'photo',
        'active'
    ];

    public function type()
    {
        return $this->belongsTo(DeviceType::class, 'deviceType_id');
    }

    public function last_service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function next_service()
    {
        return $this->belongsTo(Service::class, 'prox_service');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
