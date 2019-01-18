<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company_item extends Model
{
    protected $table = 'company_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'item_id', 'price'
    ];
}
