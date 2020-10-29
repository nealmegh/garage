<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasuresMaster extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $guarded = [];

    public function unit(){
        return $this->hasmany('App\UnitOfMeasuresMaster','measure_id','measure_id');
    }

}
