<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseProductList extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'purchase_id',
        'stock_id',
        'category_id',
        'category_name',
        'purchase_cost',
        'selling_cost',
        'opening_stock',
        'closing_stock',
        'sales_quantity',
        'sub_total'

    ];




    public function purchase()
    {
        return $this->belongsTo('App\PurchaseDetail','purchase_id','purchase_id');
    }
}
