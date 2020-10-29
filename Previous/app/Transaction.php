<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [

        'amount',
        'type',
        'method',
        'payment_for',
        'driver_id',
        'user_id',
        'notes',
        'case_id',
        'loan_id',
        'rent_id',
        'purchasedetail_id',
        'salesdetails_id',
        'inventorytransaction_id',
        'transaction_date'
    ];

    public function driver(){

        return $this->belongsTo('App\Driver');
    }
    public function rent(){

        return $this->belongsTo('App\Rent');
    }
}
