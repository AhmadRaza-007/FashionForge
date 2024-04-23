<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartProducts()
    {
        return response()->json([
            'message' => 'success',
            'collections' => Cart::whereUserId(auth()->user()->id)->get()
        ]);
    }

    public function collectionsWithSubCollection()
    {
        return response()->json([
            'message' => 'success',
            'collections' => Cart::with('subCollection')->get()
        ]);
    }
}
