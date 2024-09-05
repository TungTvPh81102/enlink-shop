<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;

    const STATUS_DRAFT = 'draft';
    const STATUS_PENDING = 'pending';
    const STATUS_PUBLISH = 'publish';

    const PRODUCT_TYPE_HOME = 'is_home';
    const PRODUCT_TYPE_HOT = 'is_hot';
    const PRODUCT_TYPE_NEW = 'is_new';

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'sku',
        'thumbnail_image',
        'price_regular',
        'price_sale',
        'description',
        'content',
        'status',
        'view',
        'product_gallery',
        'product_variants',
        'product_type',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function galleries()
    {
        return $this->hasMany(ProductGallery::class)->orderBy('order_by', 'asc');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
