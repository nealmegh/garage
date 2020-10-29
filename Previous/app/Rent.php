<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 */
class Rent extends Model
{
   protected $fillable = [

        'driver_id',
        'vehicle_id',
        'rent_type',
        'start_time',
        'end_time',
        'rent_date',
        'rent',
        'collection',
        'due',
        'remarks',
        'damage_type',
        'damage_amount',
        'paid_by',
        'discount',
        'gate_pass',
        'total_collectable',
        'status',
        'amount_collected',
        'amount_remained',
        'damage_id',
        'incident_id'
   ];

    public function driver()
    {
        return $this->belongsTo('App\Driver');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }

    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
    public function damage()
    {
        return $this->hasOne('App\damage');
    }
    public function case()
    {
        return $this->hasOne('App\Incident');
    }
}
