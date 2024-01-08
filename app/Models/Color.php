<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'clothe_id',
        'color',
        'color_code',
    ];

    public function clothes()
    {
        return $this->belongsToMany(Clothe::class);
    }
}
