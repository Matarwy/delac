<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class JSONValidate implements Rule
{


    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        if (!empty($value->getClientOriginalExtension()) && ($value->getClientOriginalExtension() == 'json')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'File is not valid json file.';
    }
}
