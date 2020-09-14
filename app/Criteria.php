<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $fillable = ['question'];

    public function triage()
    {
        return $this->hasMany('App\Triage_form');
    }
}
