<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'type',
        'registration_number',
        'tax_token',
        'tax_token_validity',
        'asset_value',
        'route_permit_number',
        'route_permit_validity',
        'fitness_number',
        'fitness_validity',
        'insurance_number',
        'insurance_validity',
        'owner_id'
    ] ;
    public function rents()
    {
        return $this->hasMany('App\Rent');
    }
    public function details()
    {
        return $this->hasOne('App\VehicleDetails');
    }
    public function owner()
    {
        return $this->belongsTo('App\Owner');
    }
    public function sales()
    {
        return $this->hasMany('App\SalesDetail');
    }

    public function cases()
    {
        return $this->hasMany('App\Incident');
    }
    public function damages()
    {
        return $this->hasMany('App\damage');
    }
}
