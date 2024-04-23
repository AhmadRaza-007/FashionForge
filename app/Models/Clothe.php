<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothe extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_collection_id',
        'name',
        'product_detail',
        'price',
        'fabric_detail',
        'Measurements',
        'gift_id',
    ];

    public function productImages() {
        return $this->hasMany(ProductImage::class);
    }

    public function productImagesWithSubCollection() {
        return $this->hasMany(ProductImage::class)->with('');
    }

    public function subCollection()
    {
        return $this->belongsTo(SubCollection::class);
    }

    public function color()
    {
        return $this->belongsToMany(Color::class, 'product_color_tables');
    }

    public function size()
    {
        return $this->belongsToMany(Size::class, 'product_size_tables');
    }

    public function gifts(){
        return $this->belongsToMany(Gift::class, 'product_gifts');
    }

    public function reviews(){
        return $this->hasMany(Review::class, 'product_id');
    }
}
