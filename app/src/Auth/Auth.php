<?php

namespace App\Auth;

use App\Models\Sessions;
use App\Models\Users as User;

//TODO Finish and test class
class Auth
{
    /**
     * return authenticated user
     * 
     * @return User|null
     */
    public static function user() : User|null
    {
        if (isset($_SESSION['user']['id'])) {
            $user = new User($_SESSION['user']['id']);
            return $user;
        }
        return null;
    }

    public static function logout()
    {
        if (isset($_SESSION['user'])) {
            $session = new Sessions();
            $session->deleteAllUserSession($_SESSION['user']['id']);
            unset($_SESSION['user']);
        }
        if (isset($_COOKIE['remember_me'])) {
            unset($_COOKIE['remember_me']);
            setcookie('remember_me', '', time()-3600);
        }
    }

    public static function sessionAuthenticated(): bool
    {
        if(isset($_SESSION['user']['id'])) {
            return true;
        }
        if (!isset($_COOKIE['remember_me'])) {
            return false;
        }
        $cookie = $_COOKIE['remember_me'];
        $explode = explode(':', $cookie);
        [$userId, $token, $mac] = explode(':', $cookie);
        if (!hash_equals(hash_hmac('sha256', $userId . ':' . $token, APP_ENCRYPTION_KEY), $mac)) {
            return false;
        }
        $user = new User($userId);
        if (isset($user->id) && hash_equals($user->token, $token)) {
            $_SESSION['user']['id'] = $user->id;
            $_SESSION['user']['name'] = $user->name;
            $_SESSION['user']['role'] = $user->role;
        }
        return false;
    }

    public static function authenticateSession(User $user, $remember = false): void
    {
        session_regenerate_id(true);
        $_SESSION['user']['id'] = $user->id;
        $_SESSION['user']['name'] = $user->name;
        $_SESSION['user']['role'] = $user->role;
        if ($remember) {
            self::setRememberMeToken($user->id);
        }
    }

    public static function setRememberMeToken(int $userId): void
    {
        $token = bin2hex(random_bytes(32));
        $cookie = $userId . ':' . $token;
        $mac = hash_hmac('sha256', $cookie, APP_ENCRYPTION_KEY);
        $cookie .= ':' . $mac;
        setcookie('remember_me', $cookie, time() + (60 * 60 * 24 * 1)); // expire 1 day
    }

}
