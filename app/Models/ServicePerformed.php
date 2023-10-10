<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePerformed extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'service_id',
        'device_id',
        'actual_hours',
        'description',
        'observations',
        'photo',
        'viewed',
        'approved',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
