<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StockUnitsDetail
 */
class StockUnitsDetail extends Model
{

    protected $fillable = [
        'stock_id',
        'category_id',
        'unit_type',
    ];

    protected $guarded = [];

    public function measures(){

        return $this->hasone('App\MeasuresMaster','measure_id','measure_id');
    }

    public function uom(){

        return $this->hasone('App\UnitOfMeasuresMaster','uom_id','uom_id')->select('uom_id','name','symbol');
    }


}
