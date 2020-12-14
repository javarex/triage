<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Terminal extends Model
{
    use SoftDeletes;

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
