<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $fillable = [
        'br_id',
        'user_id',
    	'totalamount',
        'storefront',
        'checkmoney',
        'receipt',
        'agreement',
        'comment',
        'date'
    ];
}
