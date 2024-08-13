<?php

namespace App\Validation\Rules;

use App\Models\Users;
use Respect\Validation\Rules\AbstractRule;

final class EmailAvailable extends AbstractRule
{
    public function validate($email): bool
    {
        $user = new Users();
        return !$user->findByEmail($email);//::where('id', (int) $input)->exists();
    }
}