<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'clothe_id',
        'size_id',
        'color_id',
        'quantity',
        'price',
        'total_price',
        'order_date',
        'order_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
