<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    protected $fillable = [
        'zone_id',
    	'leaderName',
        'status'
    ];
}
