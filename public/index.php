<?php

define('BASE_PATH', dirname(__DIR__));

require_once(BASE_PATH . '/vendor/autoload.php');

use App\Utils\Request;
use App\Utils\Router;

$request = new Request();

$router = new Router($request);
$router->handle();
