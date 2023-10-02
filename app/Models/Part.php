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
        'part_type_id',
        'buy_prize',
        'sell_prize',
        'stock',
    ];

    public function partType()
    {
        return $this->belongsTo(PartType::class);
    }
}
