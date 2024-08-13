<?php

namespace App\Controllers;

use App\Auth\Auth;
use App\Helpers\FlashMessage;
use App\Models\Users;
use App\Requests\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if (isset($_SESSION['user'])){
            $args = $request->getParams;
            if($args['redirect']) {
                $redirect = str_replace("-","/", $args['redirect']);;
                return $this->response->redirect($redirect);
            }
            if ($_SESSION['user']['role'] == "organizer") {
                $this->response->redirect('organizer');
            } elseif ($_SESSION['user']['role'] == "vendor") {
                $this->response->redirect('vendors');
            } else {
                echo "403 Not Athorize";
            }
        } else {
            $this->response->render('login');
        }
    }

    public function loginAuth(Request $request)
    {
        $inputs = $request->postParms;
        unset($_SESSION['user']);
        $user = new Users();
        $user->findByEmail($inputs['email']);
        if (isset($user->id) && password_verify($inputs['password'], $user->password)) {
            Auth::authenticateSession($user);
            if ($user->role == "organizer") {
                $this->response->redirect('organizer');
            } elseif ($user->role == "vendor") {
                $this->response->redirect('vendors');
            } else {
                echo "403 Not Athorize";
            }
        } else {
            FlashMessage::flash("login", "Incorrect email and/or password", FlashMessage::FLASH_ERROR);
            $_SESSION['old'] = $inputs;
            $this->response->redirect('login');
        }
    }

    public function logout()
    {
        Auth::logout();
        $this->response->redirect(ROOT);
    }
}