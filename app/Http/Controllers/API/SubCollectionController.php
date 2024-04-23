<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SubCollection;
use Illuminate\Http\Request;

class SubCollectionController extends Controller
{
    public function subCollections()
    {
        return response()->json([
            'message' => 'success',
            'subCollections' => SubCollection::get()
        ]);
    }

    public function subcollectionsWithProducts()
    {
        return response()->json([
            'message' => 'success',
            'subCollections' => SubCollection::with('products')->get()
        ]);
    }
}
