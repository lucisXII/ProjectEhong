<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    protected $fillable = [
        'br_id',
    	'brand',
        'name',
        'machineNumber',
        'condition',
        'color',
        'status'
    ];
}
