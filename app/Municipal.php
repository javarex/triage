<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipal extends Model
{
    protected $fillable = ['municipas','province_id'];
    protected $dates = ['created_at', 'updated_at'];
}
