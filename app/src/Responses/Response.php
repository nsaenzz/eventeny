<?php

namespace App\Responses;

class Response
{
    public function __construct(
        private ?string $content = '',
        private int $status = 200,
        private array $headers = [],
        private array $data = []
    )
    {
        
    }

    public function content(string $content) : void 
    {
        $this->content = $content;
    }

    public function status(int $status) : void 
    {
        $this->status = $status;
    }

    public function headers(array $headers){
        $this->headers = $headers;
    }

    public function send(?string $content, ?int $status = null, ?array $headers = []) : void 
    {
        $this->content = $content ?? $this->content;
        $this->setStatusCode($status);
        $this->setHeaders($headers);
        print_r($this->content);
    }

    public function json(string|array $content, ?int $status = null) : void 
    {
        $this->content = is_array($content) ? json_encode($content) : $content;
        if (json_validate($this->content)) {
            $this->setStatusCode($status);
            $this->setHeaders(['Content-Type' => 'application/json', 'charset' => 'utf-8']);
            echo $this->content;
        }
    }

    public function setStatusCode(?int $status = null) : void  
    {
        $this->status = $status ?? $this->status;
        http_response_code($this->status);
    }

    public function setHeaders(?array $headers = []) : void  
    {
        $this->headers = $headers ??  $this->headers;
        foreach ($this->headers as $pageHeader) {
            header($pageHeader);
        }
    }

    public function render($view, $data = [], ?int $status = null, ?array $headers = [])
    {
        $this->setStatusCode($status);
        $flashMessages = [];
        $user = null;
        if(isset($_SESSION['old'])){
            $this->data = $_SESSION['old'];
            unset($_SESSION['old']);
        };
        if(isset($_SESSION['user'])){
            $user = $_SESSION['user'];
        };
        if(isset($_SESSION['flash_message'])){
            $flashMessages = $_SESSION['flash_message'];
            unset($_SESSION['flash_message']);
        };
        $this->data = empty($data) ? $this->data : $data;
        $this->data['errors'] = [];
        if(isset($_SESSION['errors'])){
            $this->data['errors'] = $_SESSION['errors'];
            unset($_SESSION['errors']);
        };
        if ($this->status > 199 && $this->status < 300) {
            $this->setHeaders($headers);
            $this->data['pageTitle'] = $this->data['pageTitle'] ?? "Eventeny";
            extract($this->data);
            include BASE_PATH . "/src/Views/layout.php";
        }
    }

    function redirect(string $url, int $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }
    
    function back()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER'], true, 303);
        die();
    }
}