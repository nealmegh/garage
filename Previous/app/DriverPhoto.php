<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverPhoto extends Model
{
    protected  $fillable = [
      'driver_id',
      'license_photo',
      'nid',
      'nid_photo',
      'driver_photo'
    ];

    public function driver()
    {
        return $this->belongsTo('App\Driver');
    }
}
