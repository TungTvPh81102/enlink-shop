<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';

    const STATUS_RESOLVED = 'resolved';

    const STATUS_IN_PROGRESS = 'in_progress';

    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'message',
        'response',
        'response_status',
        'status',
        'response_at'
    ];
}
