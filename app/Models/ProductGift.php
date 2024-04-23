<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGift extends Model
{
    use HasFactory;

    protected $fillable = [
        'gift_id',
        'clothe_id',
    ];
}
