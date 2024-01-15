<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Clothe;
use App\http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use App\Models\SubCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::check()) {
            $cartProducts = Cart::where('user_id', auth()->user()->id)->with('clothe', 'color', 'size')->get();
            $cartPriceTotal = Cart::where('user_id', auth()->user()->id)->get();

            $total = null;
            foreach ($cartPriceTotal as $key => $price) {
                $total += $price->price * $price->quantity;
            }
            return view('Layouts.cart', compact('cartProducts', 'total'));
        }
        return redirect()->route('user.login');
    }

    public function postCart($request, $id)
    {
        Cart::create([
            'user_id' => Auth::user()->id,
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

    public function checkout()
    {
        // return Auth::user();
        $items = Cart::with('clothe', 'color', 'size')->where('user_id', Auth::user()->id)->get();
        $products = null;

        $cartPriceTotal = Cart::where('user_id', Auth::user()->id)->get();
        $total = null;
        $prices = Cart::where('user_id', Auth::user()->id)->get();
        foreach ($cartPriceTotal as $key => $price) {
            $total += $price->price * $price->quantity;
        }

        $address = Address::where('user_id', auth()->user()->id)->first();

        return view('Layouts.checkout', compact('items', 'products', 'total', 'address'));
    }

    public function checkout2($request, $id)
    {
        $products = Clothe::whereId($id)->with('color', 'size', 'productImages')->get();
        $address = null;
        return view('Layouts.checkout', compact('request', 'products', 'address'));
    }

    public function check(Request $request, $id)
    {
        switch ($request->input('action')) {
            case 'buy_now':
                return $this->checkout2($request, $id);
                break;

            case 'add_to_cart':
                return $this->postCart($request, $id);
                break;
        }
    }

    public function category($id)
    {
        $products = Clothe::where('sub_collection_id', $id)->paginate(15);

        return view('Layouts.category', compact('products'));
    }

    public function completeOrder(Request $request)
    {

        $request->validate([
            'first_name' => 'required|min:2|max:15',
            'last_name' => 'required|min:2|max:15',
            'email' => 'required|email',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'phone_number' => 'required|numeric|min:11',
        ]);

        $is_exist = Address::where('user_id', Auth::user()->id)->first();
        $is_exist = isset($is_exist) ? 1 : 0;
        // return $request->all();
        if ($request->save_information) {
            if (!$is_exist) {
                $address = Address::create([
                    'user_id' => Auth::user()->id,
                    'transaction_type' => $request->trans_type,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'address_2' => $request->address_optional,
                    'country' => $request->country,
                    'city' => $request->city,
                    'zip_code' => $request->zip_code,
                    'phone' => $request->phone_number,
                    'email_offers' => $request->email_offers,
                    'save_information' => $request->save_information,
                ]);
            }
        }
        return $request->all();
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
