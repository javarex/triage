<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = ['name','used','longitude','latitude'];

    protected $dates = ['created_at', 'updated_at'];

    public function client()
    {
        return $this->hasOne('App\Client');
    }
    public function user()
    {
        return $this->hasMany('App\User');
    }
    
    public function activity()
    {
        return $this->hasMany('App\Activity');
    }
}
