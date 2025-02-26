<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group', 'type', 'is_private'];

    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? json_decode($setting->value, true) ?? $setting->value : $default;
    }

    public static function set($key, $value = null)
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                static::updateOrCreate(
                    ['key' => $k],
                    ['value' => is_array($v) ? json_encode($v) : $v]
                );
            }
            return true;
        }

        static::updateOrCreate(
            ['key' => $key],
            ['value' => is_array($value) ? json_encode($value) : $value]
        );

        return true;
    }
}
