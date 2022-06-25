<?php

namespace App\Rules;

use App\Services\PointService;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class haveBalance implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $pointService;
    public function __construct()
    {
        $this->pointService = new PointService();
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
        return $this->pointService->convert(Auth::user()->points) >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'عفوا ، رصيدك غير كافي';
    }
}
