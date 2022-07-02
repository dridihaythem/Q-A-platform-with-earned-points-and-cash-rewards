<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\User;
use Exception;

class PointService
{
    private $rules = [];
    private $rate;

    public function __construct()
    {
        $this->rules  = Setting::where('type', 'points')->pluck('value', 'slug')->toArray();

        $this->rate = (new SettingService())->get('POINT_EQUAL_DOLLAR');
    }

    public function add(User $user, $rule)
    {
        if (!array_key_exists($rule, $this->rules)) {
            throw new Exception("UNKNOW RULE");
        }

        $user->increment('points', $this->rules[$rule]);

        $user->notifications()->create([
            'setting_id' => Setting::where('slug', $rule)->first()->id,
            'points' => $this->rules[$rule],
        ]);
    }

    public function convert($points)
    {
        return $points * $this->rate;
    }

    public function convertToPoint($amount)
    {
        return $amount / $this->rate;
    }
}
