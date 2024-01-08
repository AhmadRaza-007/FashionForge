<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'clothe_id',
        'size_id',
        'color_id',
        'quantity',
        'price',
    ];

    public function clothe()
    {
        return $this->belongsTo(Clothe::class)->with('productImages');
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
