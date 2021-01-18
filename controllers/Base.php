<?php

namespace Controller;

class Base
{
    protected $param;

    public function __construct()
    {
        $this->param = [
            "base_url" => (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on" || $_SERVER["HTTPS"] == 1) ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . "/",
            "site_name" => $_ENV["SITE_NAME"],
        ];
    }

    public function base_url($url = "")
    {
        return $this->param["base_url"] . $url;
    }

    public function template($file, $param)
    {
        chdir(__DIR__ . "/../");
        $loader = new \Twig\Loader\FilesystemLoader("template");
        $twig = new \Twig\Environment($loader);
        $twig->addExtension(new \Twig\Extra\Intl\IntlExtension());

        echo $twig->render($file, array_merge($param, $this->param));
    }
}
