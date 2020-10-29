<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryUnitsMaster extends Model
{

    protected $fillable = [
        'category_id',
        'measure_id',
        'uom_id',
        'status'
    ];

    protected $guarded = [];

    public function measures(){

        return $this->hasone('App\MeasuresMaster','measure_id','measure_id');
    }

    public function uom(){

        return $this->hasone('App\UnitOfMeasuresMaster','uom_id','uom_id')->select('uom_id','name','symbol');
    }


}
