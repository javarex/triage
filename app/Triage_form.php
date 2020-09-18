<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Triage_form extends Model
{
    public $timestamps = true;
    protected $fillable = ['client_id','form_number','criteria_id','answer'];
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
