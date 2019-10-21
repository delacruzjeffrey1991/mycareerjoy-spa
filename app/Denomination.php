<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Denomination extends Model
{
    protected $fillable = [
        'voucher_id',
        'voucher_gateway_id',
        'name',
        'description',
        'voucher_value',
        'selling_price',
        'allow_swipe',
        'swipe_terms_content',
        'swipe_mechanics_content',
        'status',
    ];

    public function voucher()
    {
        return $this->belongsTo('App\Voucher');
    }
}
