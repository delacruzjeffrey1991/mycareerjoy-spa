<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'program_id',
        'voucher_gateway_id',
        'name',
        'product_code',
        'type_id',
        'branch_list',
        'mechanics',
        'status',
    ];

    public function denominations()
    {
        return $this->hasMany('App\Denomination');
    }
}
