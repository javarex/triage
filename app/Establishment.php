<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    protected $fillable = [
        'user_id',
        'establishment_name',
        'establishment_type',
        'provCode',
        'citymunCode',
        'brgyCode',
        'agency_head',
        'admin_name',
        'email',
        'mobile_number',
        'telephone_number',
        'coordinate_long',
        'coordinate_lat',
    ];
    protected $dates = ['created_at', 'updated_at'];

    public function terminal(){
        return $this->hasMany('App\Terminal');
    }
}
