<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'User';
    protected $fillable = [
        'id', 'name', 'role','email'
    ];

    public $timestamps = false;
}
