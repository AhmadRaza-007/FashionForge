<?php

namespace App\Http\Controllers;

use App\Models\Clothe;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function review(Request $request, $productId)
    {
        // return Clothe::with('reviews')->where('id', 59)->get();
        $data = $request->validate([
            'name'      =>  'required',
            'rating'    =>  'required',
            'review'    =>  'required',
        ]);

        $data['product_id'] = $productId;
        Review::create($data);

        toastr()->addSuccess('Review Added Successfully');
        return redirect()->back();
    }

    public function getProductReviews($id){
        $reviews = Review::where('product_id', $id)->get();
        return response()->json($reviews);
    }
}
