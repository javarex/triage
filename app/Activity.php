<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['client_id','activity','office_id','venue','approve'];
    protected $dates = ['created_at','updated_at'];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function office()
    {
        return $this->belongsTo('App\Office');
    }
}
