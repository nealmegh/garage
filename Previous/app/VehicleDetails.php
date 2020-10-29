<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleDetails extends Model
{
    protected $fillable = [
        'vehicle_id',
        'registration_img',
        'fitness_img',
        'tax_img',
        'insurance_img',
        'route_permit_img'
    ];
    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }
}
