<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function subCollection()
    {
        return $this->hasMany(SubCollection::class)->with('products');
    }
}
