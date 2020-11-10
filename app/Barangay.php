<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $fillable = ['barangay', 'municipal_id'];
    protected $dates = ['created_at', 'updated_at'];
}
