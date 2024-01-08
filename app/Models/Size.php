<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    public function clothe()
    {
        return $this->belongsToMany(Clothe::class, 'product_size_tables');
    }
}
