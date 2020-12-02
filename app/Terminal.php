<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    protected $fillable = [
        'establishment_id',
        'number',
        'description'
    ];

    protected $dates = ['created_at','updated_at'];

    public function establishment()
    {
        return $this->belongsTo('App\Establishment');
    }
}
