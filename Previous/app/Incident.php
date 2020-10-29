<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
   protected $fillable = [
       'case_id',
       'penalty',
       'law',
       'doc_type',
       'last_date',
       'paid_by',
       'rent_id',
       'doc_status',
       'payment_status',
       'due_amount',
       'driver_id',
       'vehicle_id'
   ];

//    public function vehicle()
//    {
//        return $this->hasOne('App\Vehicle');
//    }
//    public function driver()
//    {
//        return $this->hasOne('App\Driver');
//    }
    public function rent()
    {
        return $this->belongsTo('App\Rent');
    }
    public function driver()
    {
        return $this->belongsTo('App\Driver');
    }

}
