<?php

namespace App\Controllers\Organizer;

use App\Controllers\Controller;
use App\Middlewares\AuthMiddleware;

class OrganizerController extends Controller
{
    public function __construct()
    {
        $this->middlewares = [
            [AuthMiddleware::class, ['role' => "organizer"]]
        ];
        parent::__construct();
    }

}