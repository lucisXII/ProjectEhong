<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable=['zoneName'];

    public $timestamps = false;
}
