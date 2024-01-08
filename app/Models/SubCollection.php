<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_id',
        'title',
        'image_url',
        'image',
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function products()
    {
        return $this->hasMany(Clothe::class)->with('productImages');
    }
    
}
