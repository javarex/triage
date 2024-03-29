<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use \Awobaz\Compoships\Compoships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'qrcode',
        'username', 
        'password', 
        'first_name', 
        'middle_name', 
        'last_name',
        'hash',
        'suffix',
        'address',
        'province_id',
        'municipal_id',
        'barangay_id',
        'sex',
        'birthday',
        'contact_number', 
        'role',
        'qredit',
        'valid_id', 
        'email',
        'email_verified_at',
        'verified',
    ];
    protected $dates = ['created_at', 'updated_at'];
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function province(){
        return $this->belongsTo('App\Province');
    } 

    public function municipal(){
        return $this->belongsTo('App\Municipal');
    } 

    public function barangay(){
        return $this->belongsTo('App\Barangay');
    }   
    
    public function establishment() {
        return $this->hasOne('App\Establishment', 'user_id', 'id');
    }
    public function log()
    {
        return $this->belongsTo('App\Log',['qrcode','qredit'],['barcode','barcode']);
    }
}
