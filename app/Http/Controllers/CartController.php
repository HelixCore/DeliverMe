<?php

namespace App\Http\Controllers;

use App\cart;
use App\item;
use App\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $order = order::where('user_id', '=', Auth::user()->id)->where('status', '=', '0')->first();
        $products= [];
        if($order){
            $products = cart::where('order_id', '=', $order->id)->get()->map(function ($item) {
                return item::find($item->coit_id);
            });
        }
        return view('User.car', ['order' => $order, 'products' => $products]);
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
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(cart $cart)
    {
        //
    }

    public function extract(Request $request)
    {
        $coit_id = DB::table('company_items')->where('item_id', '=', $request->input('product'))->first()->id; 
        $cart = cart::where('order_id', '=', $request->input('order'))->where('coit_id', '=',$coit_id);
        $cart->delete();
        return back();
    }
}
