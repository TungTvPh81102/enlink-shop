<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    const STATUS_DRAFT = 'draft';

    const STATUS_PENDING = 'pending';

    const STATUS_PUBLISHED = 'published';

    protected $fillable = [
        'title',
        'content',
        'published_at',
        'status',
        'blog_categories_id',
        'photo',
        'slug'
    ];

    public function blogCategories()
    {
        return $this->belongsTo(BlogCategories::class, 'blog_categories_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}
