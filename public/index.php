<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Utils\Request;
use App\Utils\Router;

$request = new Request();

$router = new Router($request);
$router->handle();
