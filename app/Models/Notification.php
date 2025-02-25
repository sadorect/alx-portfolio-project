<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'type',
        'message',
        'priority',
        'status',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];
}
