<?php

namespace App\Middlewares;

use App\Auth\Auth;
use App\Exceptions\ForbiddenException;

class AuthMiddleware extends Middleware
{
    public function execute(string $role) : void
    {
        if (Auth::sessionAuthenticated()) {
            if ($_SESSION['user']['role'] == $role){
                return;
            }
        }
        throw new ForbiddenException();
    }
}
