<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckingTool extends Model
{
    protected $primaryKey = 'ct_id';
    protected $fillable = [
        'tool_id',
        'br_id',
        'user_id',
        'remain',
        'check',
        'comment',
        'date'
    ];
    public $timestamps = false;
}
