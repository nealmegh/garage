<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesProductList extends Model
{
//    use SoftDeletes;


    protected $fillable = [

        'sales_id',
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


    public function sales()
    {
        return $this->belongsTo('App\SalesDetail','sales_id');
    }
    public function stock()
    {
        return $this->belongsTo('App\StockDetail','stock_id');
    }


}
