<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Cybe\Router;

$router = new Router();

$router->get("/", function () {
    echo "test";
});

$router->serve();
