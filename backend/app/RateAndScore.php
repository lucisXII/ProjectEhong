<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RateAndScore extends Model
{
    protected $primaryKey = 'rs_id';
    protected $fillable = [
        'sh_id',
        'br_id',
        'user_id',
        'score',
        'date'
    ];
    public $timestamps = false;
}
