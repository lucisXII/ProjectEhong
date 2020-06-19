<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conclude extends Model
{
    protected $primaryKey = 'cc_id';
    protected $fillable = [
        'br_id',
    	'score',
        'date',
    ];
    const CREATED_AT = 'date';
    const UPDATED_AT = null;
    // public $timestamps = true;

    public function branch()
    {
        return $this->hasOne('App\Branch', 'br_id', 'br_id');
    }
}
