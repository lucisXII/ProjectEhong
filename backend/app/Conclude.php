<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conclude extends Model
{
    protected $fillable = [
        'br_id',
    	'score',
        'date',
    ];
    public $timestamps = false;
}
