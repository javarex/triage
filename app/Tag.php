<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['date','time_from','time_to'];
    protected $dates = ['created_at','updated_at'];
}
