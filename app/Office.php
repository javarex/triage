<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = ['name','division','user_id','remarks'];

    protected $dates = ['created_at', 'updated_at'];

    public function client()
    {
        return $this->hasOne('App\Client');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function activity()
    {
        return $this->hasMany('App\Activity');
    }
}