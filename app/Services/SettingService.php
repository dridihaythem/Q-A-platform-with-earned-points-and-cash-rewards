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
}
