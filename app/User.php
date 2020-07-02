<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'national_code', 'personal_code', 'username', 'password', 'gender', 'api_token'
    ];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return sprintf('%s %s', $this->attributes['first_name'], $this->attributes['last_name']);
    }
}
