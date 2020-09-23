<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['user_id', 'first_name','middle_name','last_name','age','sex','address','contact_number','office_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function triage()
    {
        return $this->hasMany('App\Triage_form');
    }

    public function activity()
    {
        return $this->hasMany('App\Activity');
    }
    
    public function office()
    {
        return $this->belongsTo('App\Office');
    }
}
