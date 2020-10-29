<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'amount',
        'due_amount',
        'status','driver_id'
    ];

    public function driver(){

        return $this->belongsTo('App\Driver');
    }
}
