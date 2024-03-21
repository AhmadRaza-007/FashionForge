<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gifts = Gift::get();
        return view('admin.gift', compact('gifts'));
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
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'image' => 'required',
        ]);

        $imagePath = '';
        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $imagePath = 'uploads/' . $imageName;
        }

        Gift::create([
            'name' => $request->name,
            'details' => $request->details,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->back();
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
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);
        $imagePath = null;
        // return isset($imagePath) ? 'true' : 'false';
        $previousImage = $gift->find($request->id)->image;

        if ($request->has('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            $imagePath = 'uploads/' . $imageName;
        }

        $gift->find($request->id)->update([
            'name' => $request->name,
            'details' => $request->details,
            'price' => $request->price,
            'image' => isset($imagePath) ? $imagePath : $previousImage,
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
