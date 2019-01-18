<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'emp_id', 'status', 'total'
    ];

    public function getPrecio(Type $var = null)
    {
        $price = DB::table('company_items')
                          ->join('carts' , 'carts.coit_id' , '=' , 'company_items.id')
                          ->where ('order_id', $var)
                          ->sum('price'); 
        
        $extras = DB::table('company_extras')
                          ->join('extra_items' , 'extra_items.coex_id' , '=' , 'company_extras.id')
                          ->join('listextras'  , 'extra_items.id' , '=' , 'listextras.exit_id')
                          ->join('carts'       , 'listextras.cart_id' , '=' , 'carts.id')
                          ->join('orders'      , 'orders.id' , '=' , 'carts.order_id')
                          ->where ('order_id', $var)
                          ->sum('price'); 
       $precioTotal = $price + $extras;
       dd($precioTotal);
       return $precioTotal;
    }
}

$orden = order::where('user_id', '=', Auth::user()->id)->where('status', '=', '0')->get();