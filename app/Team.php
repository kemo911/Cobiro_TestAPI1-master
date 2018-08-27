<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'Team';
    protected $fillable =['id','team_title','team_owner'];
    public $timestamps = false;
}
