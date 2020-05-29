<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spares extends Model
{
    protected $fillable = [
        'br_id',
        'code',
        'brand',
        'name',
        'remain',
        'costprice'
    ];
}
