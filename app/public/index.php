<?php

use App\Requests\Request;
use Respect\Validation\Factory;

session_start();

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/vendor/autoload.php';
require_once BASE_PATH . '/config/config.php';
require_once BASE_PATH . '/kernel/kernel.php';

Factory::setDefaultInstance(
    (new Factory())
        ->withRuleNamespace('App\\Validation\\Rules')
        ->withExceptionNamespace('App\\Validation\\Exceptions')
);

$request = Request::createFromGlobals();
$kernel = new Kernel();
$kernel->handle($request);