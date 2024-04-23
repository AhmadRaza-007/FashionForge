<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

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
    // public function store(Request $request)
    // {
    //     ini_set('memory_limit', '1000M');

    //     // $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
    //     // if (!$receiver->isUploaded()) {
    //     //     // file not uploaded
    //     // }

    //     // $fileReceived = $receiver->receive(); // receive file
    //     // if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
    //         // $file = $fileReceived->getFile(); // get file
    //         $file = $request->file('file'); // get file
    //         $extension = $file->getClientOriginalExtension();
    //         $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
    //         $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name

    //         Storage::disk('google')->put($fileName, file_get_contents($file));

    //         // delete chunked file
    //         // unlink($file->getPathname());
    //         return [
    //             'filename' => $fileName
    //         ];
    //     // }

    //     // otherwise return percentage informatoin
    //     // $handler = $fileReceived->handler();
    //     // return [
    //     //     // 'done' => $handler->getPercentageDone(),
    //     //     'status' => true
    //     // ];



    //     // $file = $request->file('file');
    //     // dd($request->file('file')->getClientOriginalName());
    //     // $name = $file->getClientOriginalName();
    //     // $filename = time() . '-' . $name;

    //     // $request->file('file')->store($request->file('file')->getClientOriginalName(), 'google');
    //     // Storage::disk('google')->put($filename, file_get_contents($file));
    //     // $details = Storage::disk('google')->getMetaData($filename);
    //     // $url = Storage::disk('google')->url($filename);
    //     // $visibility = Storage::disk('google')->getVisibility($filename);
    //     // Storage::disk('google')->get($filename);
    //     // dump($details);
    //     // dump($url);
    //     // dump($visibility);
    //     // return redirect()->back();
    //     // return redirect('https://drive.google.com/file/d/' . $details['path'] .'/preview');
    // }

    public function store(Request $request)
    {
        $file = $request->file('file');

        if (!$file->isValid()) {
            return back()->withErrors('Invalid file upload');
        }

        $fileSize = $file->getSize();
        $chunkSize = 1024 * 1024; // Adjust chunk size as needed (e.g., 1 MB)
        $chunks = ceil($fileSize / $chunkSize);
        $fileName = str_replace('.' . $file->getClientOriginalExtension(), '', $file->getClientOriginalName()); // Filename without extension
        $fileName .= '_' . md5(time()) . '.' . $file->getClientOriginalExtension(); // Unique filename
        $folderName = '18Gd3gfNSH8Ame2hAR5AhCoLPBnRwi3O5'; // Unique filename
        $uploadedChunks = []; // Array to track uploaded chunks

        try {
            $adapter = Storage::disk('google'); // Get the Google Drive adapter

            $handle = fopen($file->getRealPath(), 'rb'); // Open file for reading

            // Upload each chunk
            for ($i = 0; $i < $chunks; $i++) {
                $chunkStart = $i * $chunkSize;
                $chunkEnd = min($chunkStart + $chunkSize - 1, $fileSize - 1);

                // Seek to the chunk start position
                fseek($handle, $chunkStart);

                // Read the chunk data
                $chunkData = fread($handle, $chunkEnd - $chunkStart + 1);

                $adapter->write("$folderName/$fileName.part$i", $chunkData, ['visibility' => 'restricted']); // Upload chunk
                $uploadedChunks[] = "$folderName/$fileName.part$i"; // Track uploaded chunk info
            }

            // fclose($handle); // Close the file handle

            // ... rest of your assembly logic (assuming manual assembly)
            // Assembly Logic: Combine uploaded chunks into a single file
            $assembledFile = fopen("$folderName/$fileName.part0", 'wb'); // Open for writing the assembled file
            foreach ($uploadedChunks as $key => $chunk) {
                $chunkStream = $adapter->readStream($chunk); // Get chunk data stream
                while (!feof($chunkStream)) {
                    fwrite($assembledFile, fread($chunkStream, 65536)); // Write chunk data to assembled file (adjust buffer size as needed)
                }
                fclose($chunkStream); // Close chunk stream
            }
            fclose($assembledFile); // Close assembled file stream

            return response()->json(['message' => 'File uploaded successfully!', 'filename' => $fileName]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); // Handle upload errors gracefully
        }
    }

    // public function store(Request $request)
    // {
    //     ini_set('memory_limit', '1000M');
    //     $file = $request->file('file');

    //     if (!$file->isValid()) {
    //         return back()->withErrors('Invalid file upload');
    //     }

    //     $fileSize = $file->getSize();
    //     $chunkSize = 1024 * 1024; // Adjust chunk size as needed (e.g., 1 MB)
    //     $chunks = ceil($fileSize / $chunkSize);
    //     $fileName = str_replace('.' . $file->getClientOriginalExtension(), '', $file->getClientOriginalName()); // Filename without extension
    //     $fileName .= '_' . md5(time()) . '.' . $file->getClientOriginalExtension(); // Unique filename

    //     try {
    //         $adapter = Storage::disk('google'); // Get the Google Drive adapter

    //         $handle = fopen($file->getRealPath(), 'rb'); // Open file for reading

    //         // Upload each chunk
    //         for ($i = 0; $i < $chunks; $i++) {
    //             $chunkStart = $i * $chunkSize;
    //             $chunkEnd = min($chunkStart + $chunkSize - 1, $fileSize - 1);

    //             // Seek to the chunk start position
    //             fseek($handle, $chunkStart);

    //             // Read the chunk data
    //             $chunkData = fread($handle, $chunkEnd - $chunkStart + 1);

    //             $adapter->write("18Gd3gfNSH8Ame2hAR5AhCoLPBnRwi3O5/$fileName.part$i", $chunkData, ['visibility' => 'restricted']); // Optional: Set visibility

    //             Log::info("Uploading chunk $i (size: " . strlen($chunkData) . ")");
    //         }

    //         fclose($handle); // Close the file handle

    //         return response()->json(['message' => 'File uploaded successfully!', 'filename' => $fileName]);
    //     } catch (Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500); // Handle upload errors gracefully
    //     }
    // }


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
