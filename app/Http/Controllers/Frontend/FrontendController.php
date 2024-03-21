<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Clothe;
use App\http\Controllers\Controller;
use App\Models\Address;
use App\Models\Buy;
use App\Models\Cart;
use App\Models\Collection;
use App\Models\Gift;
use App\Models\Order;
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
        $isGift = false;
        return view('Layouts.detail', compact('products', 'isGift'));
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
        if (auth()->check()) {

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
        } else {
            return redirect()->route('user.login');
        }
    }

    public function cartIncrement(Request $request, $id)
    {
        if (auth()->check()) {
            $cartItem = Cart::find($id);
            $cartItem->update(['quantity' => $request['editQuantity_' . $id]]);
            $cartPriceTotal = Cart::where('user_id', auth()->user()->id)->get();
            $total = null;
            $prices = Cart::where('user_id', auth()->user()->id)->get(['price', 'quantity']);
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
        } else {
            return redirect()->route('user.login');
        }
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
        $isGift = $request->isGift;
        if (!$request->isGift) {
            $products = Clothe::whereId($id)->with('color', 'size', 'productImages')->get();
        }
        if ($request->isGift) {
            $products = Gift::whereId($id)->get();
        }
        $address = Address::where('user_id', auth()->user()->id)->first();
        return view('Layouts.checkout', compact('request', 'products', 'address', 'isGift'));
    }

    public function check(Request $request, $id)
    {
        switch ($request->input('action')) {
            case 'buy_now':
                // $request->all();
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
        // return $request->all();
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

        $cart_items = Cart::where('user_id', auth()->user()->id)->get();

        $array = [$request->all()];
        $total_price = 0;
        // return $array;
        foreach ($array as $key => $value) {

            for ($i = 0; $i < count($value['product']); $i++) {
                // return count($value['product']);
                $total_price += $value['price'][$i] * $value['quantity'][$i];
            }
            // return $total_price;

            for ($i = 0; $i < count($value['product']); $i++) {
                Order::create([
                    'user_id' => auth()->user()->id,
                    'clothe_id' => $value['product'][$i],
                    'size_id' => $value['size'][$i],
                    'color_id' => $value['color'][$i],
                    'quantity' => $value['quantity'][$i],
                    'price' => $value['price'][$i] * $value['quantity'][$i],
                    'total_price' => $total_price,
                    'order_date' => date('Y-m-d H:i:s'),
                    'order_status' => 'Pending',
                ]);
                if (isset($cart_items[$i])) {
                    $cart_items[$i]->delete();
                }
            }
        }

        toastr()->addSuccess('Order Placed Successfully');
        return redirect()->route('user.purchased');
    }

    public function address()
    {
        $address = Address::where('user_id', auth()->user()->id)->first();
        return view('Layouts.userDetails', compact('address'));
    }

    public function gifts(Request $request)
    {
        $gifts = Gift::get();
        return view('Layouts.gift', compact('gifts'));
    }

    public function gift($id, Request $request)
    {
        $gifts = Gift::whereId($id)->get();
        $isGift = true;
        return view('Layouts.detail', compact('gifts', 'isGift'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
