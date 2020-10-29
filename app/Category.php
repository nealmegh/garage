<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name'
    ];


    protected $guarded = [];

    public function units(){

        return $this->hasmany('App\CategoryUnitsMaster','category_id','id')->select('category_id','measure_id','uom_id');
    }

    public function stocks(){

        return $this->hasmany('App\StockDetail','category_id','id');
    }
}
