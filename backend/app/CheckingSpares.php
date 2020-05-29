<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckingSpares extends Model
{
    protected $fillable = [
        's_id',
        'br_id',
        'user_id',
        'remain',
        'check',
        'comment',
        'date'
    ];
}
