<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subheading extends Model
{
    protected $primaryKey = 'sh_id';
    protected $fillable = [
        'hd_id',
        'subheadingName',
    	'score'
    ];

    public function rateAndScore(){
        return $this->hasMany('App\RateAndScore', 'sh_id', 'sh_id');
    }
}
