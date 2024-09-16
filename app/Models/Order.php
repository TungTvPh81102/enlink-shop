<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const PAYMENT_METHOD_COD = 'cod';

    const PAYMENT_METHOD_VNPAY = 'vnpay';

    protected $fillable = [
        'user_id',
        'user_name',
        'user_email',
        'user_phone',
        'is_ship_user_same_user',
        'ship_user_name',
        'ship_user_email',
        'ship_user_phone',
        'payment_method',
        'status_delivery',
        'payment_status',
        'total_price'
    ];

    public function address()
    {
        return $this->hasOne(Addresse::class);
    }

    public function order_details() {
        return $this->hasMany(OrderDetail::class);
    }

    public function order_coupons(){
        return $this->hasOne(OrderCoupon::class, 'order_id');
    }
}
