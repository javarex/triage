<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use \Awobaz\Compoships\Compoships;

    protected $guarded = [];
    protected $table = 'logs';
    protected $dates = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->hasOne('App\User',['qrcode','qredit'],['barcode','barcode']);
    }
}
