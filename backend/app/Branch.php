<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $primaryKey = 'br_id';
    protected $fillable = [
        'zone_id',
    	'branchName',
        'open_date',
        'close_date'
    ];

    public function conclude()
    {
        return $this->hasMany('App\conclude', 'br_id', 'br_id');
    }
}
