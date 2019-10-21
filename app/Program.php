<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'voucher_gateway_id',
        'merchant_id',
        'name',
        'description',
        'status',
    ];
}
