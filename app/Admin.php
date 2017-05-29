<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticable;

class Admin extends Authenticable
{
    protected $fillable = ['name', 'email', 'password', 'remember_token'];

    protected $hidden = ['password', 'remember_token'];
}
