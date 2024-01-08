<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizeTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'clothe_id',
        'size_id',
    ];
}
