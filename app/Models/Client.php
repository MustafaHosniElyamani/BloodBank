<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\Authenticatable;
// use Illuminate\Database\Eloquent\Model;                           you can replace comments
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
class Client extends Authenticatable  //extends Model implements Authenticatable
{
    // use AuthenticatableTrait;
    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('phone', 'email', 'password', 'blood_type_id', 'd_o_b', 'last_donation_date', 'pin_code', 'city_id');
    protected $hidden = [
        'password',
        'api_token',
    ];
    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function blood_type()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }

    public function bloodTypes()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Models\Governorate');
    }
    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }

}
