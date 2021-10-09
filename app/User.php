<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable {

    use Notifiable;
    //use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'password',  'email_verified_at', 'remember_token', 'user_type', 'status', 'picture', 'password_reset_code'
//    ];

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

    public function getDistrict() {
        return $this->belongsTo('App\District', 'district_id', 'id');
    }

    public function getPermanentDistrict() {
        return $this->belongsTo('App\District', 'permanent_address_district_id', 'id');
    }

}
