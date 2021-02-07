<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Terminal extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'qrcode',
        'establishment_id',
        'number',
        'description',
        'coordinate_long',
        'coordinate_lat',
    ];

    protected $dates = ['created_at','updated_at'];

    public function establishment()
    {
        return $this->belongsTo('App\Establishment');
    }
    public function logs()
    {
        return $this->hasMany('App\Logs');
    }
}
