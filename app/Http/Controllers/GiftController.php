<?php

namespace App\Http\Controllers;

use App\Models\Clothe;
use App\Models\Color;
use App\Models\Gift;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\SubCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    // $gifts = Gift::get();
    // return view('admin.gift', compact('gifts'));
    // }

    public function index(Request $request)
    {
        $products = Gift::get();
        $productCount = Gift::count();

        // return $products;
        return response()->view('admin.gift', compact('products', 'productCount'));
        // return redirect()->back()->withErrors();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // return $request->all();
            $image_path = null;
            if ($request->file('image')) {
                $file = $request->file('image');
                $fileName = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);
                $image_path = 'uploads/' . $fileName;
            }

            Gift::create([
                'name' => $request->gift_name,
                'gift_detail' => $request->gift_detail,
                'image' => $image_path,
                'image_url' => $request->image_url,
            ]);

            // return redirect('/clothes');
            toastr()->addSuccess('Product Color Added Successfully');
            return redirect()->back();
            // }
        } catch (Exception $exception) {
            toastr()->addError('Something Went Wrong' . $exception->getMessage() . ' ' . $exception->getLine());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gift  $gift
     * @return \Illuminate\Http\Response
     */
    public function show(Gift $gift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gift  $gift
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Gift $gift)
    {
        return $gift->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gift  $gift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gift $gift)
    {
        // return $request->all();
        // $request->validate([
        //     'name' => 'required',
        //     'price' => 'required',
        // ]);
        $image_path = null;
        if ($request->file('image')) {
            $file = $request->file('image');
            $fileName = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $image_path = 'uploads/' . $fileName;
        }
        // return isset($imagePath) ? 'true' : 'false';
        $previousImage = $gift->find($request->gift_id_hidden)->image;

        $gift->find($request->gift_id_hidden)->update([
            'name' => $request->gift_name,
            'gift_detail' => $request->gift_detail,
            'image' => isset($image_path) ? $image_path : $previousImage,
            'image_url' => $request->image_url,
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gift  $gift
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Gift $gift)
    {
        $gift->find($id)->delete();
        toastr()->addSuccess('Order Status Updated Successfully');
        return redirect()->back();
    }
}
