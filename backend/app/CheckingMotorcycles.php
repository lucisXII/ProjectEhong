<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckingMotorcycles extends Model
{
    protected $fillable = [
        'm_id',
        'br_id',
        'user_id',
        'status',
        'unready',
        'comment',
        'date'
    ];
}
