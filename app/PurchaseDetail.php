<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseDetail extends Model
{
    use SoftDeletes;


    protected $fillable = [

        'supplier_id',
        'supplier_name',
        'supplier_address',
        'supplier_contact1',
        'opening_balance',
        'opening_due',
        'purchase_total',
        'description',
        'grand_total',
        'payment',
        'closing_balance',
        'closing_due',
        'mode',
        'billnumber',
        'billdate',
        'tax_description',
        'tax_percent',
        'tax_amount',
        'discount_percent',
        'discount_amount',
        'purchase_date'

    ];

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function stock()
    {
        return $this->hasOne('App\StockDetail','stock_id','stock_id')->select(array('stock_id', 'stock_name'));
    }

    public function category()
    {
        return $this->hasOne('App\Category','id','category_id')->select(array('id', 'category_name'));
    }

    public function supplier()
    {
        return $this->hasOne('App\Supplier','id','supplier_id')->select(array('id', 'supplier_name'));
    }
}
