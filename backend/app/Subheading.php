<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subheading extends Model
{
    protected $fillable = [
        'hd_id',
        'subheadingName',
    	'score'
    ];
}
