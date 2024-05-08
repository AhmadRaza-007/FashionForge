<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Clothe;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function products(Request $request)
    {
        // return $request->all();
        try {
            $data = $request->validate([
                'product_id'    => 'required|numeric',
                'name'          => 'required|max:12',
                'rating'        => 'required|numeric',
                'review'        => 'required',
            ]);
            $data['user_id'] = Auth::check() ? Auth::user()->id : null;

            Review::create($data);

            return response()->json([
                'message' => 'success',
                'products' => Clothe::with('reviews')->where('id', $data['product_id'])->get()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
