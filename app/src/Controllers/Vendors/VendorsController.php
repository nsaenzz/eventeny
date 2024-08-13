<?php

namespace App\Controllers\Vendors;

use App\Controllers\Controller;
use App\Middlewares\AuthMiddleware;

class VendorsController extends Controller
{
    public function __construct()
    {
        $this->middlewares = [
            [AuthMiddleware::class, ['role' => "vendor"]]
        ];
        $this->data['viewPage'] = 'vendor';
        parent::__construct();
    }

}
