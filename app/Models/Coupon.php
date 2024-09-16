<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    const TYPE_PERCENT = 'percent';
    const TYPE_FIXED = 'fixed';

    protected $fillable = [
        'name',
        'code',
        'type',
        'value',
        'status',
        'max_discount_percentage',
        'min_order_total',
        'max_uses',
        'expire_date',
    ];


    protected function checkCoupon($code) {
        return $this->where('code', $code)
            ->where('status', 1)
            ->where('expire_date', '>=', date('Y-m-d'))
            ->where('max_uses', '>=', 1)
            ->first();
    }

}
