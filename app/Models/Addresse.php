<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresse extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'province_id',
        'district_id',
        'ward_id',
        'street_address',
    ];
}
