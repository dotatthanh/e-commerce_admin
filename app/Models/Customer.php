<?php

namespace App\Models;

use App\Notifications\CustomerResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

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

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomerResetPasswordNotification($token));
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
