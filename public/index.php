<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Cybe\Router;
use \Controller\Home;

$router = new Router();

$router->get("/", [[new Home(), "index"]]);

$router->serve();
