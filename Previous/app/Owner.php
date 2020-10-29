<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = [
      'user_id',
      'phone_number',
      'photo'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function vehicles()
    {
        return $this->hasMany('App\Vehicle');
    }
}
