<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function collections()
    {
        return response()->json([
            'message' => 'success',
            'collections' => Collection::get()
        ]);
    }

    public function collectionsWithSubCollection()
    {
        return response()->json([
            'message' => 'success',
            'collections' => Collection::with('subCollection')->get()
        ]);
    }
}
