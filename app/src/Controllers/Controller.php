<?php

namespace App\Controllers;

use App\Exceptions\ForbiddenException;
use App\Helpers\FlashMessage;
use App\Responses\Response;

abstract class Controller
{
    protected array $middlewares = [];
    protected array $data = [];

    public function __construct(
        protected Response $response = new Response()
    )
    {
        $this->runMiddleWares();
    }

    public function runMiddleWares()
    {
        try{
            foreach ($this->middlewares as [$middleware, $vars]) {
                call_user_func_array([new $middleware, "execute"], $vars);
            }
        } catch(ForbiddenException $e) {
            FlashMessage::flash($e->getCode(), $e->getMessage(), FlashMessage::FLASH_ERROR);
            $this->response->redirect(ROOT);
            exit();
        }
        
    }
}