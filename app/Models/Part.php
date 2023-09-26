<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'serial_number',
        'description',
        'buy_prize',
        'sell_prize',
        'stock',
    ];
}
