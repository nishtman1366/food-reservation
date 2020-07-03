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
        'first_name', 'last_name', 'username', 'password', 'national_code', 'personal_code', 'gender', 'api_token', 'level'
    ];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return sprintf('%s %s', $this->attributes['first_name'], $this->attributes['last_name']);
    }

    public function setApiTokenAttribute($value)
    {
        $this->attributes['api_token'] = $this->createToken();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Illuminate\Support\Facades\Hash::make($value);
    }

    private function createToken()
    {
        $token = \Illuminate\Support\Str::random(60);
        $existence = $this->where('api_token', $token)->exists();
        if ($existence) return $this->createToken();

        return $token;
    }
}
