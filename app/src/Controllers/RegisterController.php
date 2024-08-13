<?php

namespace App\Controllers;

use App\Models\Users;
use App\Requests\Request;
use App\Validation\NewUserRegistrationValidator;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        if (isset($_SESSION['user'])){
            if ($_SESSION['user']['role'] == "organizer") {
                $this->response->redirect('organizer');
            } elseif ($_SESSION['user']['role'] == "vendor") {
                $this->response->redirect('vendor');
            } else {
                echo "403 Not Athorize";
            }
        } else {
            $this->response->render('register');
        }
    }

    /**
     * Store a newly created user.
     */
    public function store(Request $request)
    {
        $newUserRegistration = new NewUserRegistrationValidator();
        $inputs = $request->postParms;
        $inputs['role'] = $inputs['role'] ?? 'vendor';
        $validation = $newUserRegistration->validate($inputs);

        if ($validation->failed()) {
            $_SESSION['old'] = $inputs;
            $this->response->redirect('register');
        }

        $userData = [
            'name' => trim($inputs['name']),
            'email' => trim($inputs['email']),
            'password' => password_hash($inputs['password'], PASSWORD_DEFAULT),
            'role' => $inputs['role'],
        ];

        $user = new Users();
        $newUser = $user->create($userData);

        return $this->response->send($newUser);
    }

    // TODO
    /**
     * Show the form for editing the user resource.
     */
    // public function edit(Product $product)
    // {
    // }
}