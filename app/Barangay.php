<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $fillable = ['brgyCode','brgyDesc','regCode','provCode','citymunCode'];
    

    public function user(){
        return $this->hasOne('App\User');
    }
    
}
