<?php

namespace Controller;

chdir(__DIR__ . "/../");

class Base
{
    protected $param;

    public function __construct()
    {
        $this->param = [
            "base_url" => (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on" || $_SERVER["HTTPS"] == 1) ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . "/",
            "site_name" => "Akbar Aditama",
        ];
    }

    public function base_url($url = "")
    {
        return $this->param["base_url"] . $url;
    }

    public function template($file, $param)
    {
        $loader = new \Twig\Loader\FilesystemLoader("template");
        $twig = new \Twig\Environment($loader);

        echo $twig->render($file, array_merge($param, $this->param));
    }
}
