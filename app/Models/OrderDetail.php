<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_variant_id',
        'quantity',
        'product_name',
        'product_sku',
        'product_price_regular',
        'product_price_sale',
        'product_image_thumbnail',
        'variant_size_name',
        'variant_color_name',
    ];
}
