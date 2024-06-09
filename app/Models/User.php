<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'msisdn', 'email', 'password',
    ];

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

    public function setMsisdnAttribute($msisdn){
        if ($msisdn) {
            $this->attributes['msisdn'] = '880'.substr($msisdn,-10);   
        }else{

            $this->attributes['msisdn'] = null;
        }
    
    }

    // public function setPasswordAttribute($password){
    //     $this->attributes['password'] = Hash::make($password);
    // }
    // public function getMsisdnAttribute(){
    //     return '880'.substr($this->msisdn,-10);   
    // }

}
