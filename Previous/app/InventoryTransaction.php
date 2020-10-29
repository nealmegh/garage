<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryTransaction extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'type',
        'sales_id',
        'purchase_id',
        'customer_id',
        'supplier_id',
        'subtotal',
        'payment',
        'balance',
        'due',
        'mode',
        'transaction_id'
    ];

    protected $guarded = [];

    protected $dates = ['deleted_at'];

//    public function supplier()
//    {
//        return $this->hasOne('App\Supplier','id','id');
//    }

//    public function customer()
//    {
//        return $this->hasOne('App\CustomerDetail','id','customer_id')->select(array('id', 'customer_name'));
//    }
}
