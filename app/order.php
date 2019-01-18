<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = ['user_id','emp_id','status'];

    public function getPrecio(Type $var = null)
{
    
}

}

$orden = order::where('user_id', '=', Auth::user()->id)->where('status', '=', '0')->get();


