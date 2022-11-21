<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('product_categorys')
            ->select('*')
            ->orderByRaw('prodCategory')
            ->get();

        return view('user.Transaction.orderForm', compact('posts'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Products $products)
    {
        $posts = DB::table('product_categorys')
            ->select('*')
            ->orderByRaw('prodCategory')
            ->get();

        return view('user.Transaction.orderForm', compact('posts', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $posts = DB::table('product_categorys')
            ->select('*')
            ->orderByRaw('prodCategory')
            ->get();

        Order::create([
            'user_id' => $request->input('user_id'),
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
            'payment_type' => $request->input('payment_type'),
            'status' => "Pending",
            'rating' => $request->input('rating'),
            'review' => $request->input('review'),
        ]);

        return view('user.View.viewHome', compact('posts'));
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
    public function edit(Request $request)
    {
        $where = array('orders.id' => $request->id);
        $order  = order::join('products', 'orders.product_id', '=', 'products.id')
        ->join('product_categorys', 'products.prodCategory_id', '=', 'product_categorys.id')

        ->where($where)->first();
        
        return response()->json($order);
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
    public function destroy(Order $order)
    {
        //
    }
}
