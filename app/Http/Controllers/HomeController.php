<?php

namespace App\Http\Controllers;

use App\cart;
use App\item;
use App\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = item::all();
        return view('home', ['productos'=>$productos]);
    }


    public function addCar(Request $request)
    {
        $item = item::find($request->input('item'));
        ///Buscar el precio de este item y se lo asigna al total
        $orden = order::where('user_id', '=', Auth::user()->id)->where('status', '=', '0')->first();
        // dd($orden);
        if($orden){
            $carts = cart::create([
                'order_id' => $orden->id,
                'coit_id' => $item->id
            ]);
        }else{
            $orden = order::create([
                'user_id' => Auth::user()->id,
                'emp_id' => null,
                'status' => 0,
                'total' => 0,
            ]);
            $carts = cart::create([
                'order_id' => $orden->id,
                'coit_id' => $item->id
            ]);
        }
        
        return redirect()->back()->with('message', 'Se agrego al carrito correctamente');
    }
}
