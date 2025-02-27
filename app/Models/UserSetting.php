<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email_enabled',
        'sms_enabled',
        'days_before',
        'notification_time',
        'birthday_template',
        'wedding_template',
    ];

    protected $casts = [
        'email_enabled' => 'boolean',
        'sms_enabled' => 'boolean',
        'days_before' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
