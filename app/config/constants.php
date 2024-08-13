<?php

//App
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define('ROOT', 'http://localhost');
    define('IMAGE_PATH', BASE_PATH . '/public/img/');
}
define('APP_ENCRYPTION_KEY', $_ENV['APP_ENCRYPTION_KEY']);

//DB
define('MYSQL_HOST', $_ENV['MYSQL_HOST']);
define('MYSQL_USER', $_ENV['MYSQL_USER']);
define('MYSQL_ROOT_PASSWORD', $_ENV['MYSQL_ROOT_PASSWORD']);
define('MYSQL_DATABASE', $_ENV['MYSQL_DATABASE']);
define('MYSQL_PORT', $_ENV['MYSQL_PORT']);