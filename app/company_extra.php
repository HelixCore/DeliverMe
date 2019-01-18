<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class company_extra extends Model
{
    protected $table = 'company_extras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id', 'extra_id', 'precio'
    ];

}
