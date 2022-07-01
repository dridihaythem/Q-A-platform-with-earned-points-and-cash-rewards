<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public function get(string $slug): string
    {
        $setting  = Setting::where('slug', $slug)->first();

        return $setting ? $setting->value : null;
    }

    public function save(string $slug, string $value)
    {
        if ($value != null) {
            Setting::where('slug', $slug)->update(['value' => $value]);
        }
    }
}
