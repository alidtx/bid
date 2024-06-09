<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MsisdnRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $pattern = '/^(?:\+88|01)?(?:\d{11}|\d{13})$/';
        return preg_match($pattern, $value);
    }
   
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Phone Number is invalid';
    }
}
