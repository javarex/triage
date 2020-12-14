<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $fillable = ['user_id','terminal_id'];

    protected $dates = ['created_at', 'updated_at'];
}
