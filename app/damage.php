<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class damage extends Model
{
    protected $fillable = [
        'amount',
        'due_amount',
        'status',
        'driver_id',
        'rent_id',
        'vehicle_id',
        'partial_payment',
        'owner_amount',
        'partial_payment_amount',
        'details',
        'driver_due_amount',
        'driver_paid_amount',
        'status'
    ];

    public function driver(){

        return $this->belongsTo('App\Driver');
    }
    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }
    public function rent()
    {
        return $this->belongsTo('App\Rent');
    }

}
