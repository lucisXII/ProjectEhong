<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $primaryKey = 'cost_id';
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
    // const CREATED_AT = 'date';
    public $timestamps = false;
}
