<?php
namespace App\Requests;

class Request
{
    public readonly array $params;

    public function __construct(
        // $_GET, $_POST, $_COOKIE, $_FILES, $_SERVER
        public readonly array $getParams,
        public readonly array $postParms,
        public readonly array $cookies,
        public readonly array $files,
        public readonly array $server,
    )
    {
        parse_str(file_get_contents('php://input'), $params);
        if (is_array($params)) {
            $this->params = $params;
        }
    }

    public static function createFromGlobals() : static 
    {
        return new static($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
    }

    public function getPathInfo() : string 
    {
        return strtok($this->server['REQUEST_URI'], '?');
    }

    public function getMethod() : string
    {
        return $this->server['REQUEST_METHOD'];
    }
}

