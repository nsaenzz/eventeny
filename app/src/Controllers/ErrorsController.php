<?php

namespace App\Controllers;

use App\Helpers\FlashMessage;
use App\Models\Users;
use App\Requests\Request;

class ErrorsController extends Controller
{
    public function notFound()
    {
        $this->response->render('404');
    }
}