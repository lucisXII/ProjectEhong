<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckingTool extends Model
{
    protected $fillable = [
        't_id',
        'br_id',
        'user_id',
        'remain',
        'check',
        'comment',
        'date'
    ];
}
