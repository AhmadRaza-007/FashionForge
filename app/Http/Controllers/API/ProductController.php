<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Clothe;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products()
    {
        return response()->json([
            'message' => 'success',
            'subCollections' => Clothe::with('productImages', 'color', 'size', 'gifts')->get()
        ]);
    }
}
