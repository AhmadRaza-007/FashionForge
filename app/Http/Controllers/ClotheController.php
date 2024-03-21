<?php

namespace App\Http\Controllers;

use App\Models\Clothe;
use App\Models\Collection;
use App\Models\Color;
use App\Models\ProductColorTable;
use App\Models\ProductImage;
use App\Models\ProductSizeTable;
use App\Models\Size;
use App\Models\SubCollection;
use Exception;
use Illuminate\Http\Request;

class ClotheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCollection = SubCollection::with('products')->get();
        $products = Clothe::with('productImages')->with('color')->with('size')->get();
        $colors = Color::get();
        $sizes = Size::get();
        $product_images = ProductImage::get();
        $subCollectionById = SubCollection::get();
        $productCount = Clothe::count();

        // return $products;
        $cookie = cookie('active', 'clothe', 60 * 24 * 30);
        return response()->view('admin.clothes', compact('subCollection', 'products', 'product_images', 'subCollectionById', 'productCount', 'colors', 'sizes'))->withCookie($cookie);

    }

    public function productById($id)
    {
        $products = Clothe::with('productImages')->whereSubCollectionId($id)->get();
        $subCollection = SubCollection::get();
        $subCollectionById = SubCollection::whereId($id)->get();
        $productCount = Clothe::whereSubCollectionId($id)->count();
        $colors = Color::get();
        $sizes = Size::get();
        // return $subCollection;
        $cookie = cookie('active', 'clothe', 60 * 24 * 30);
        return response()->view('admin.clothes', compact('subCollection', 'products', 'subCollectionById', 'productCount', 'colors', 'sizes'))->withCookie($cookie);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        // return $request->all();
        try {

            $images = $request->file('product_images');
            if ($request->hasFile('product_images')) {
                foreach ($images as $image) {
                    // $product_images = $request->file('product_images');
                    $fileName =  time() . '-' . $image->getClientOriginalName();
                    $image->move('assets/uploads', $fileName);
                    $image_path = 'assets/uploads/' . $fileName;
                    $image_arr[] = $image_path;
                }
            }

            // return $request->product_measurements;

            $image_links = $request['product_image_url'];
            foreach ($image_links as $url) {
                $image_link_arr[] = $url;
            }

            $image_colors = $request['product_colors'];
            foreach ($image_colors as $color) {
                $image_color_arr[] = $color;
            }

            $prodyct_sizes = $request['product_sizes'];
            foreach ($prodyct_sizes as $size) {
                $product_size_arr[] = $size;
            }

            // return $product_size_arr;
            if ($images && $image_links && $image_colors && $prodyct_sizes) {

                $clothe = Clothe::create([
                    'sub_collection_id' => $request->sub_collection_id,
                    'name' => $request->product_name,
                    'product_detail' => $request->product_details,
                    'price' => $request->product_price,
                    'fabric_detail' => $request->product_fabric_details,
                    'Measurements' => $request->product_measurements,
                ]);

                foreach ($image_arr as $key => $image) {
                    $ProductImage = ProductImage::create([
                        'clothe_id' => $clothe->id,
                        'product_images' => $image,
                        'product_image_url' => $image_link_arr[$key],
                    ]);
                }

                foreach ($image_color_arr as $key => $color) {
                    $ProductColor = ProductColorTable::create([
                        'clothe_id' => $clothe->id,
                        'color_id' => $color,
                    ]);
                }

                foreach ($product_size_arr as $key => $size) {
                    $ProductSize = ProductSizeTable::create([
                        'clothe_id' => $clothe->id,
                        'size_id' => $size,
                    ]);
                }
                // return redirect('/clothes');
                toastr()->addSuccess('Product Color Added Successfully');
                return redirect()->back();
            }
        } catch (Exception $exception) {
            toastr()->addError('Something Went Wrong' . $exception->getMessage() . ' ' . $exception->getLine());
            return redirect()->back();
        }
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
     * @param  \App\Models\Clothe  $clothe
     * @return \Illuminate\Http\Response
     */
    public function show(Clothe $clothe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clothe  $clothe
     * @return \Illuminate\Http\Response
     */
    public function editClothes($id)
    {
        return Clothe::with('productImages', 'subCollection', 'color', 'size')->whereId($id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clothe  $clothe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request->all();
        // try {

        // $request->validate([
        //     'name' => 'required',
        // ]);

        //                      For Update
        $clothe = Clothe::find($request->clothe_id_hidden);
        $clothe->update([
            'sub_collection_id' => $request->edit_clothe_id,
            'name' => $request->edit_product_name,
            'product_details' => $request->product_name,
            'price' => $request->edit_product_price,
            'fabric_detail' => $request->edit_product_fabric_details,
            'Measurements' => $request->edit_product_measurements,
        ]);

        //                      For Updating Image And Link
        $images = $request->file('edit_product_images');
        if ($request->hasFile('edit_product_images')) {
            foreach ($images as $image) {
                $fileName =  time() . '-' . $image->getClientOriginalName();
                $image->move('assets/uploads', $fileName);
                $image_path = 'assets/uploads/' . $fileName;
                $image_arr[] = $image_path;
            }
            if ($request['edit_product_image_url']) {
                $image_links = $request['edit_product_image_url'];
                foreach ($image_links as $url) {
                    $image_link_arr[] = $url;
                }
            }
            foreach ($image_arr as $key => $image) {
                ProductImage::create([
                    'clothe_id' => $clothe->id,
                    'product_images' => $image,
                    'product_image_url' => $image_link_arr[$key],
                ]);
            }
        }

        //                      For Updating Color
        if ($request['edit_product_colors']) {
            $image_colors = $request['edit_product_colors'];
            foreach ($image_colors as $color) {
                $image_color_arr[] = $color;
            }

            $colorArrSize = sizeof($image_color_arr);
            $productColor = ProductColorTable::where('clothe_id', $clothe->id)->get();
            $productColorSize = sizeof($productColor);
            foreach ($image_color_arr as $key => $colorr) {
                if ($key < sizeof($productColor)) {
                    $productColor[$key]->update([
                        'color_id' => $colorr,
                    ]);
                } else if ($key >= sizeof($productColor)) {
                    ProductColorTable::create([
                        'clothe_id' => $clothe->id,
                        'color_id' => $colorr,
                    ]);
                }

                if ($colorArrSize < $productColorSize) {
                    for ($index = $colorArrSize - 1; $index <= $productColorSize - 1; $index++) {
                        if ($index === 0) {
                            continue;
                        }
                        $productColor[$index]->delete();
                    }
                }
            }
        }

        //                      For Updating Size
        if ($request['edit_product_sizes']) {
            $product_sizes = $request['edit_product_sizes'];
            foreach ($product_sizes as $size) {
                $product_sizes_arr[] = $size;
            }

            $sizeArrSize = sizeof($product_sizes_arr);
            $productSize = ProductSizeTable::where('clothe_id', $clothe->id)->get();
            $productSizeSize = sizeof($productSize);
            foreach ($product_sizes_arr as $key => $size) {
                if ($key < sizeof($productSize)) {
                    $productSize[$key]->update([
                        'size_id' => $size,
                    ]);
                } else if ($key >= sizeof($productSize)) {
                    ProductSizeTable::create([
                        'clothe_id' => $clothe->id,
                        'size_id' => $size,
                    ]);
                }
                if ($sizeArrSize < $productSizeSize) {
                    for ($index = $sizeArrSize - 1; $index <= $productSizeSize - 1; $index++) {
                        if ($index === 0) {
                            continue;
                        }
                        $productSize[$index]->delete();
                    }
                }
            }
        }
        toastr()->addSuccess('Product Updated Successfully');
        return redirect()->back();
        // } catch (Exception $exception) {
        //     toastr()->addError($exception->getMessage() . ' ' . $exception->getLine());
        //     return redirect()->back();
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clothe  $clothe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Clothe::whereId($id)->delete();
            ProductImage::whereClotheId($id)->delete();
            toastr()->addSuccess('Product Deleted Successfully');
            return redirect()->back();
        } catch (Exception $exception) {
            toastr()->addError($exception->getMessage() . ' ' . $exception->getLine());
            return redirect()->back();
        }
    }

    public function destroyImage($id)
    {
        try {
            ProductImage::whereId($id)->delete();
            toastr()->addSuccess('Product Image Removed Successfully');
            return redirect()->back();
        } catch (Exception $exception) {
            toastr()->addError($exception->getMessage() . ' ' . $exception->getLine());
            return redirect()->back();
        }
    }

    public function destroySize($clotheId, $sizeId)
    {
        try {
            // return [$clotheid, $sizeId];
            ProductSizeTable::where('clothe_id', $clotheId)->where('size_id', $sizeId)->delete();
            toastr()->addSuccess('Product Size Removed Successfully');
            return redirect()->back();
        } catch (Exception $exception) {
            toastr()->addError($exception->getMessage() . ' ' . $exception->getLine());
            return redirect()->back();
        }
    }
    public function destroyColor($clotheId, $colorId)
    {
        // return [$clotheid, $colorId];
        try {
            ProductColorTable::where('clothe_id', $clotheId)->where('color_id', $colorId)->delete();
            toastr()->addSuccess('Product Color Removed Successfully');
            return redirect()->back();
        } catch (Exception $exception) {
            toastr()->addError($exception->getMessage() . ' ' . $exception->getLine());
            return redirect()->back();
        }
    }
}
