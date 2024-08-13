<?php

namespace App\Validation\Rules;

use App\Models\Users;
use Respect\Validation\Rules\AbstractRule;

class UserExists extends AbstractRule
{
    public function validate($input): bool
    {
        $user = new Users();
        return (bool) $user->find((int) $input);//::where('id', (int) $input)->exists();
    }
}