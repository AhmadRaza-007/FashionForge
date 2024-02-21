<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Size::with('clothe')->get();
        return view('admin.googledrive');
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
        ini_set('memory_limit', '1000M');

        $file = $request->file('file');
        // dd($request->file('file')->getClientOriginalName());
        $name = $file->getClientOriginalName();
        $filename = time() . '-' . $name;

        // $request->file('file')->store($request->file('file')->getClientOriginalName(), 'google');
        Storage::disk('google')->put($filename, file_get_contents($file));
        $details = Storage::disk('google')->getMetaData($filename);
        $url = Storage::disk('google')->url($filename);
        $visibility = Storage::disk('google')->getVisibility($filename);
        // Storage::disk('google')->get($filename);
        // dump($details);
        // dump($url);
        dump($visibility);
        // return redirect()->back();
        // return redirect('https://drive.google.com/file/d/' . $details['path'] .'/preview');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}
