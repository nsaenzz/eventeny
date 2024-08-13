<?php

namespace App\Controllers;

use App\Auth\Auth;
use App\Helpers\FlashMessage;
use App\Models\Applications;
use App\Models\Users;
use App\Requests\Request;

class HomepageController extends Controller
{
    public function index()
    {
        $this->response->render('index');
    }
}