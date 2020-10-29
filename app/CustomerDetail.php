<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerDetail extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_address',
        'customer_contact1',
        'customer_contact2',
        'balance',
        'due'
    ];

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function sales()
    {
        return $this->hasMany('App\SalesDetail', 'customer_id', 'id');
    }

}
