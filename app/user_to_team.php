<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_to_team extends Model
{
    protected $table = 'user_to_team';
    protected $fillable = ['user_id','team_id'];
    public $timestamps = false;
}
