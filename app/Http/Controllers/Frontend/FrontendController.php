<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Clothe;
use App\http\Controllers\Controller;
use App\Models\Buy;
use App\Models\Cart;
use App\Models\SubCollection;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Clothe::with('productImages')->paginate(12);
        $products = Clothe::with('productImages')->paginate(12);
        $subCollection = SubCollection::get();
        // return $subCollection;
        return view('Layouts.home', compact('products', 'subCollection'));
    }
    
    public function productDetail($id)
    {
        $products = Clothe::with('productImages', 'subCollection')->where('id', $id)->get();
        // return $products;
        return view('Layouts.detail', compact('products'));
    }

    public function cart()
    {
        $cartProducts = Cart::with('clothe', 'color', 'size')->get();
        $cartPriceTotal = Cart::get();

        $total = null;
        foreach ($cartPriceTotal as $key => $price) {
            $total += $price->price * $price->quantity;
        }
        return view('Layouts.cart', compact('cartProducts', 'total'));
    }

    public function postCart($request, $id)
    {
        // return $request->all();
        Cart::create([
            'clothe_id' => $id,
            'size_id' => $request->size,
            'color_id' => $request->color,
            'quantity' => $request->quantity,
            'price' => $request->hidden_price,
        ]);

        toastr()->addSuccess('Product Added to Cart Successfully');
        return redirect()->back();
    }

    public function cartIncrement(Request $request, $id)
    {
        $cartItem = Cart::find($id);
        $cartItem->update(['quantity' => $request['editQuantity_' . $id]]);
        $cartPriceTotal = Cart::get();
        $total = null;
        $prices = Cart::get();
        foreach ($cartPriceTotal as $key => $price) {
            $total += $price->price * $price->quantity;
            // print_r(
            //     $price->price * $price->quantity . '<br>'
            // );
        }

        return response()->json([
            'cart' => $cartItem,
            'total' => $total,
            'prices' => $prices,
        ]);
    }

    public function cartDelete($id)
    {
        $cartItem = Cart::whereId($id);
        $cartItem->delete();
        toastr()->addSuccess('Product Removed From Cart Successfully');
        return redirect()->back();
    }

    public function buyNow($id)
    {
    }

    public function postBuy($request, $id)
    {
        Buy::create([
            'clothe_id' => $id,
            'size_id' => $request->size,
            'color_id' => $request->color,
            'quantity' => $request->quantity,
            'price' => '5200',
        ]);

        return view('Layouts.buy');
    }

    public function check(Request $request, $id)
    {
        switch ($request->input('action')) {
            case 'buy_now':
                return $this->postBuy($request, $id);
                break;

            case 'add_to_cart':
                return $this->postCart($request, $id);
                break;
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
