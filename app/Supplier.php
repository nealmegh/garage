<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Supplier extends Model
{
    protected $fillable = [
        'supplier_name',
        'supplier_email',
        'supplier_address',
        'supplier_contact1',
        'supplier_contact2',
        'balance',
        'due'
    ];

    public function purchase()
    {
        return $this->hasMany('App\PurchaseDetail', 'supplier_id', 'id');
    }



}
