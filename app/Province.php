<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [ 'psgcCode','provDesc','regCode','provCode'];

    public function user(){
        return $this->hasOne('App\User');
    }
}
