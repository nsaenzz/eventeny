<?php

use App\Helpers\FlashMessage;
use App\Requests\Request;
use App\Responses\Response;
use FastRoute\RouteCollector;

class Kernel
{
    public function handle(Request $request) : void {
        $dispatcher = \FastRoute\simpleDispatcher(function (RouteCollector $routeCollector){
            $routes = include BASE_PATH . '/Routes/web.php';
            foreach ($routes as $route) {
                $routeCollector->addRoute(...$route);
            }
        });

        //Dispatch a URI, to obtain the route info
        $routeInfo = $dispatcher->dispatch(
            $request->server['REQUEST_METHOD'],
            $request->getPathInfo()
        );
        
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                $response = new Response();
                $response->redirect(ROOT.'/404');
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                FlashMessage::flash("405", "Method Not Allowed", FlashMessage::FLASH_ERROR);
                $response = new Response();
                $response->back();
                break;
            case FastRoute\Dispatcher::FOUND:
                [$controller, $method] = $routeInfo[1];
                $vars[] = $request;
                $vars[] = $routeInfo[2];
                call_user_func_array([new $controller, $method], $vars);
                break;
        }

        
    }

}