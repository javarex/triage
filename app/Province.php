<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [ 'province'];
    protected $dates = ['created_at', 'updated_at'];

    public function user(){
        return $this->hasOne('App\User');
    }
}
