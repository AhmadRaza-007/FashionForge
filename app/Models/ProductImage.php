<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'clothe_id',
        'product_images',
        'product_image_url',
    ];

    public $timestamps = false;

    public function productImages() {
        return $this->belongsTo(Clothe::class);
    }
}
