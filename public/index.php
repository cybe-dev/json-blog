<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Cybe\Router;
use \Controller\Api;
use \Controller\Article;
use \Controller\Home;
use \Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__ . "/../.env");

//instantiate controller class
$home = new Home();
$article = new Article();
$api = new Api;

//instantiate router
$router = new Router();

$router->get("/", [[$home, "index"]]);
$router->get("/page/:page", [[$home, "index"]]);
$router->get("/article/:slug", [[$article, "index"]]);

$router->post("/api/article", [
    [$api, "verify"],
    [$api, "post"],
]);

$router->post("/api/article/delete/:slug", [
    [$api, "verify"],
    [$api, "destroy"],
]);

$router->serve();
