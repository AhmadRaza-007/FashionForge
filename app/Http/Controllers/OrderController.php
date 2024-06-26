<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $purchase = Order::with('clothe', 'color', 'size')
    //         ->where('user_id', auth()->user()->id)
    //         ->get();
    //     return view('Layouts.purchased', compact('purchase'));
    // }

    public function orders()
    {
        $purchase = Order::with('clothe', 'color', 'size', 'user')
            ->orderBy('id', 'desc')
            ->get();
        // $cookie = cookie('active', 'orders', 60 * 24 * 30);
        return response()->view('admin.orders', compact('purchase'));
    }

    public function pendingOrders()
    {
        $purchase = Order::with('clothe', 'color', 'size', 'user')
            ->where('order_status', 'Pending')
            ->orderBy('id', 'desc')
            ->get();
        // $cookie = cookie('active', 'orders', 60 * 24 * 30);
        return response()->view('admin.orders', compact('purchase'));
    }

    public function shippedOrders()
    {
        $purchase = Order::with('clothe', 'color', 'size', 'user')
            ->where('order_status', 'Shipped')
            ->orderBy('id', 'desc')
            ->get();
        // $cookie = cookie('active', 'orders', 60 * 24 * 30);
        return response()->view('admin.orders', compact('purchase'));
    }

    public function deliveredOrders()
    {
        $purchase = Order::with('clothe', 'color', 'size', 'user')
            ->where('order_status', 'Delivered')
            ->orderBy('id', 'desc')
            ->get();
        // $cookie = cookie('active', 'orders', 60 * 24 * 30);
        return response()->view('admin.orders', compact('purchase'));
    }

    public function orderDetails($id)
    {
        $purchase = Order::with('clothe', 'color', 'size', 'user', 'gift')->whereId($id)->first();
        // return $purchase;
        $link = 'productDetail/' . $purchase->clothe->id;
        // $link = null;
        // return $link;
        $userAddress = Address::whereUserId($purchase->user_id)->first();
        return view('admin.orderDetails', compact('purchase', 'userAddress', 'link'));
    }

    public function orderStatus(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update([
            'order_status' => $request->order_status
        ]);
        toastr()->addSuccess('Order Status Updated Successfully');
        return redirect()->back();
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::find($id)->delete();
        return redirect()->route('admin.orders')->with('success', 'Order deleted successfully');
    }
}
