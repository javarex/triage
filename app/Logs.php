<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $fillable = ['barcode','terminal_id','time_in','time_out'];

    protected $dates = ['created_at', 'updated_at'];

    public function terminal()
    {
        return $this->belongsTo('App\Terminal');
    }
}
