<?php

namespace App\Services;

use App\Models\User;
use Exception;

class PointService
{
    private $rules = [];
    private $rate = 0.1;

    public function __construct()
    {
        $this->rules  = [
            'CREATE_ACCOUNT' => 5,
            'CREATE_ACCOUNT_WITH_MY_LINK' => 10,
            'CREATE_QUESTION' => 5,
            'CREATE_ANSWER' => 5,
            'CREATE_ANSWER_ON_MY_OWN_QUESTION' => 1,
            'CREATE_ANSWER_MORE_300_WORDS' => 20,
            'BEST_ANSWER' => 10,
        ];
    }

    public function add(User $user, $rule)
    {
        if (!array_key_exists($rule, $this->rules)) {
            throw new Exception("UNKNOW RULE");
        }

        $user->increment('points', $this->rules[$rule]);
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
