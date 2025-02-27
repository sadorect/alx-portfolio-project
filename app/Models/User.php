<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Celebrant;
use App\Models\UserSetting;
use App\Traits\LogsActivity;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use LogsActivity;
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
       'role',
       'birthday_msg',
       'wedding_msg',
       'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function celebrants()
    {
        return $this->hasMany(Celebrant::class);
    }

    public function scopeSearch($query, $term)
{
    return $query->where(function($query) use ($term) {
        $query->where('name', 'like', "%{$term}%")
              ->orWhere('email', 'like', "%{$term}%");
    });
}

public function logActivity($type, $description, $metadata = [])
{
    return $this->activities()->create([
        'type' => $type,
        'description' => $description,
        'metadata' => $metadata
    ]);
}

public function activities()
{
    return $this->hasMany(Activity::class);
}

public function settings()
{
    return $this->hasOne(UserSetting::class);
}



}