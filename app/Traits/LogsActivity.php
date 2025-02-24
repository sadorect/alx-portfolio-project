<?php

namespace App\Traits;

use App\Models\Activity;

trait LogsActivity
{
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function logActivity($type, $description, $metadata = [])
    {
        return $this->activities()->create([
            'type' => $type,
            'description' => $description,
            'metadata' => $metadata
        ]);
    }
}
