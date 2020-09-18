<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $fillable = ['question'];
    protected $dates = ['created_at', 'updated_at'];

    public function triage()
    {
        return $this->hasMany('App\Triage_form');
    }
}
