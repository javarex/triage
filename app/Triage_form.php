<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Triage_form extends Model
{
    public $timestamps = true;
    protected $fillable = ['client_id','activity_id','criteria_id','answer','location'];
    protected $dates = ['created_at', 'updated_at'];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function criteria()
    {
        return $this->belongsTo('App\Criteria');
    }
}
