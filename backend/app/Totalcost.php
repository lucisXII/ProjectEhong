<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Totalcost extends Model
{
    protected $primaryKey = 'tcost_id';
    protected $fillable = [
        'br_id',
    	'totalamount',
        'storefront',
        'dateUpdate'
    ];
}
