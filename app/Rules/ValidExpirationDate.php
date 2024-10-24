<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class ValidExpirationDate implements Rule
{
    public function passes($attribute, $value)
    {
        // Parse the provided expiration date
        $expirationDate = Carbon::createFromFormat('m/y', $value);

        // Compare the parsed expiration date with the current date
        return $expirationDate->isFuture();
    }

    public function message()
    {
        return 'The expiration date must be in the future.';
    }
}
