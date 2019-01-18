<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class extra_item extends Model
{
    protected $table = 'extra_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coex_id', 'coit_id',
    ];
}
