<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\SubCollection;
use Illuminate\Http\Request;

class SubCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $collection = Collection::get();
        $collection = Collection::get();
        $subCollection = SubCollection::with('collection')->get();
        $subName = $subCollection->first();
        // return $subCollection;
        return view('admin.subCollection', compact('collection', 'subCollection', 'subName'));
    }

    public function collection($id)
    {
        
        $collection = Collection::get();
        $subCollection = SubCollection::with('collection')->whereCollectionId($id)->get();
        $subName = $subCollection->first();
        // return $subName;
        return view('admin.subCollection', compact('collection', 'subCollection', 'subName'));
    }

    public function editSubCollection($id)
    {
        return SubCollection::with('collection')->where('id', $id)->first();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->hasFile('sub_collection_image')) {
            $sub_collection_image = $request->file('sub_collection_image');
            $fileName =  time() . '-' . $sub_collection_image->getClientOriginalName();
            $sub_collection_image->move('assets/uploads', $fileName);
            $sub_collection_image_path = 'assets/uploads/' . $fileName;
        }

        $subCollection = SubCollection::create([
            'collection_id' => $request->collection_id,
            'title' => $request->sub_collection_title,
            'image_url' => $request->sub_collection_image_url,
            'image' => $sub_collection_image_path,
        ]);

        return redirect()->back();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCollection  $subCollection
     * @return \Illuminate\Http\Response
     */
    public function show(SubCollection $subCollection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCollection  $subCollection
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $editSubCollection = SubCollection::find($request->sub_collection_id_hidden);

        $sub_collection_image_path = null;

        if ($request->hasFile('sub_collection_image')) {
            $sub_collection_image = $request->file('sub_collection_image');
            $fileName =  time() . '-' . $sub_collection_image->getClientOriginalName();
            $sub_collection_image->move('assets/uploads', $fileName);
            $sub_collection_image_path = 'assets/uploads/' . $fileName;
        }

        $editSubCollection->update([
            'collection_id' => $request->collection_id,
            'title' => $request->sub_collection_title,
            'image_url' => $request->sub_collection_image_url,
            'image' => $sub_collection_image_path ? $sub_collection_image_path : $editSubCollection->image,
        ]);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCollection  $subCollection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCollection $subCollection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCollection  $subCollection
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SubCollection::whereId($id)->delete();
        return redirect('/subCollection');
    }
}
