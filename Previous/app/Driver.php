<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'user_id',
        'phone_number',
        'license_number',
        'license_validity',
        'address',
		'ref_name',
		'ref_phone',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function rents()
    {
        return $this->hasMany('App\Rent');
    }
    public function cases()
    {
        return $this->hasMany('App\Incident');
    }

    public function loans()
    {
        return $this->hasMany('App\Loan');
    }

    public function damages()
    {
        return $this->hasMany('App\damage');
    }
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

    public function details()
    {
        return $this->hasOne('App\DriverPhoto');
    }
}
