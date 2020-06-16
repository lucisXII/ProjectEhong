<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Heading extends Model
{
    protected $primaryKey = 'hd_id';
    protected $fillable=['group_id', 'headingName'];

    public function subHeading(){
        return $this->hasMany('App\Subheading', 'hd_id', 'hd_id');
    }

    public function group(){
        return $this->hasOne('App\Group', 'group_id', 'group_id');
    }

    
    public function rateAndScore(){
        return $this->hasMany('App\Subheading', 'App\RateAndScore', 'sh_id' ,'sh_id');
    }

    // public function groups(){
    //     return $this->hasOne('โมเดล', 'ไอดีจากโมเดล', 'ไอดีโมเดลนี้');
    // }
}
