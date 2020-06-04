<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'position',
        'username',
        'password',
        'status'
    ];

    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }
}
