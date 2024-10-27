<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    public $guard_name = 'web';

    protected $fillable = [
        'code',
        'name',
        'email',
        'phone_number',
        'address',
        'password',
        'birthday',
        'gender',
    ];

    protected $hidden = [
        'password',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
