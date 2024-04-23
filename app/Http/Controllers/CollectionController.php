<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\SubCollection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        // $collection = Collection::get();
        $collection = Collection::with('subCollection')->get();
        // return $collection;
        // return Collection::with('subCollection')->get();
        $cookie = cookie('active', 'clothingCollection', 60 * 24 * 30);

        return response()->view('admin.clothingCollection', compact('collection'));
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

    public function store(Request $request)
    {
        //
    }

    public function show(Collection $collection)
    {
        //
    }

    public function edit(Request $request)
    {
        $editCollection = Collection::find($request->collection_id_edit);

        $editCollection->update([
            'name' => $request->edit_name,
        ]);
        toastr()->addSuccess('Collection Updated Successfully');
        return redirect('/admin/clothingCollection');
    }

    public function update(Request $request, Collection $collection)
    {
        //
    }

    public function destroy($id)
    {
        // return $id;
        Collection::whereId($id)->delete();
        toastr()->addSuccess('Collection Deleted Successfully');
        return redirect('/admin/clothingCollection');
    }
}
