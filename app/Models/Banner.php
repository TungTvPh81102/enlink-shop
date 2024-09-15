<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    const TYPE_SLIDER = 'slider';
    const TYPE_INCENTIVE = 'incentive ';
    const TYPE_SMALL = 'small';

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'link',
        'btn_title',
        'type',
        'status'
    ];
}

