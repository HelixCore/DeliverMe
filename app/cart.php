<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $table = 'carts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'coit_id'
    ];
}
