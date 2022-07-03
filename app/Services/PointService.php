<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\Answer;
use App\Models\Setting;
use Illuminate\Support\Str;

class PointService
{
    private $rules = [];
    private $rate;

    public function __construct()
    {
        $this->rules = Setting::where('type', 'points')->pluck('value', 'slug')->toArray();

        $this->rate = (new SettingService())->get('POINT_EQUAL_DOLLAR');
    }

    public function handleAnswerPoints(Answer $answer)
    {
        if ($answer->user_id == $answer->question->user_id) {
            $this->add($answer->user, 'CREATE_ANSWER_ON_MY_OWN_QUESTION');
        } else if (Str::length($answer->content) > 300) {
            $this->add($answer->user, 'CREATE_ANSWER_MORE_300_CHARS');
        } else if (Str::length($answer->content) > 150) {
            $this->add($answer->user, 'CREATE_ANSWER');
        }
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
