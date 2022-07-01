<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class minWords implements Rule
{
    private $min;
    private $attribute;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $min)
    {
        $this->min = $min;
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
        $this->attribute = $attribute;
        $trimmed = trim($value);
        $numWords = count(explode(' ', $trimmed));
        return $numWords >= $this->min;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'عفوا ال' . $this->attribute . ' يجب أن يحتوي على الأقل على ' . $this->min . ' كلمة';
    }
}
