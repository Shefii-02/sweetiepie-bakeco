<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UniqueEmailExceptCurrentUser implements Rule
{
    public function passes($attribute, $value)
    {
        $currentUserEmail = Auth::user()->email;

        return DB::table('users')
            ->where('email', $value)
            ->where('email', '<>', $currentUserEmail)
            ->doesntExist();
    }

    public function message()
    {
        return 'The email address is already in use.';
    }
}
