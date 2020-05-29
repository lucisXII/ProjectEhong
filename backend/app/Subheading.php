<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subheading extends Model
{
    protected $fillable = [
        'sh_id',
        'hd_id',
        'subheadingName',
    	'score'
    ];
}
