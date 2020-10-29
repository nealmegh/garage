<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SalesDetail
 */
class SalesDetail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_address',
        'customer_contact1',
        'opening_balance',
        'opening_due',
        'sales_total',
        'discount_percent',
        'discount_amount',
        'tax_description',
        'tax_percent',
        'tax_amount',
        'sales_description',
        'grand_total',
        'payment',
        'closing_balance',
        'closing_due',
        'mode',
        'billnumber',
        'billdate',
        'vehicle_id',
        'sales_date'
    ];




    public function stock()
    {
        return $this->hasOne('App\StockDetail','stock_id','stock_id')->select(array('stock_id', 'stock_name'));
    }

    public function category()
    {
        return $this->hasOne('App\Category','id','category_id')->select(array('id', 'category_name'));
    }

    public function customer()
    {
        return $this->hasOne('App\CustomerDetail','id','customer_id')->select(array('id', 'customer_name'));
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }

    public function productList()
    {
        return $this->hasMany('App\SalesProductList', 'sales_id');
    }

}
