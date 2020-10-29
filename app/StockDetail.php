<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class StockDetail
 */
class StockDetail extends Model
{
    use SoftDeletes;



    protected $fillable = [
        'stock_name',
        'category_id',
        'category_name',
        'purchase_cost',
        'selling_cost',
        'supplier_id',
        'supplier_name',
        'stock_quantity',

    ];

    public function getSellingCostAttribute($value)
    {
        if($value){
            return (float) $value;
        }else {
            return '';
        }

    }


    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->hasOne('App\Category','id','category_id')->select(array('id', 'category_name'));
    }

    public function supplier()
    {
        return $this->hasOne('App\Supplier','id','supplier_id')->select(array('id', 'supplier_name'));
    }

    public function stock_unit()
    {
        return $this->hasOne('App\StockUnitsDetail','stock_id');
    }
}
