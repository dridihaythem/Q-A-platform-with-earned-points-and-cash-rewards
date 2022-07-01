<?php

namespace App\Rules;

use App\Services\SettingService;
use Illuminate\Contracts\Validation\Rule;

class minAmountToWithdraw implements Rule
{
    private $minAmount = 0;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->minAmount = (new SettingService())->get('MIN_AMOUNT_TO_WITHDRAW');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->minAmount <= $value)
            return true;
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'عفوا أقل مبلغ قابل للسحب هو ' . $this->minAmount . ' دولار';
    }
}
