<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipal extends Model
{
    protected $fillable = ['psgcCode','citymunDesc','regDesc','provCode','citymunCode'];

    public function user(){
        return $this->hasOne('App\User');
    }
}
