<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\SubCollection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $collection = Collection::get();
        $collection = Collection::with('subCollection')->get();
        // return $collection;
        // return Collection::with('subCollection')->get();

        return view('admin.clothingCollection', compact('collection'));
    }

    public function sidebar()
    {
        $collections = Collection::with('subCollection')->get();
        return view('admin.sidebar', compact('collections'));
    }

    // public function collection($id)
    // {
    //     // $collection = SubCollection::with('collection')->whereCollectionId($id)->get();
    //     $collection = Collection::with('subCollection')->whereId($id)->get();
    //     // return $collection;
    //     return view('admin.clothingCollection', compact('collection'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $collection = Collection::create([
            'name' => $request->name,
        ]);
        toastr()->addSuccess('Collection Created Successfully');
        return redirect('admin/clothingCollection');
    }


    public function editCollection($id)
    {
        $collection = Collection::where('id', $id)->first();
        return $collection;
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
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $editCollection = Collection::find($request->collection_id_edit);

        $editCollection->update([
            'name' => $request->edit_name,
        ]);
        toastr()->addSuccess('Collection Updated Successfully');
        return redirect('/admin/clothingCollection');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $id;
        Collection::whereId($id)->delete();
        toastr()->addSuccess('Collection Deleted Successfully');
        return redirect('/admin/clothingCollection');
    }
}
