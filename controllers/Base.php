<?php

namespace Controller;

class Base
{
    protected $param, $host;

    public function __construct()
    {
        $this->host = (isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] == "on" || $_SERVER["HTTPS"] == 1) ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"] . "/";
        $this->param = [
            "base_url" => $this->host,
            "current_url" => $this->base_url($_SERVER["REQUEST_URI"]),
            "site_name" => $_ENV["SITE_NAME"],
            "site_description" => $_ENV["SITE_DESCRIPTION"],
            "author" => $_ENV["AUTHOR"],
            "profile_pic" => $_ENV["PROFILE_PIC"],
            "instagram_link" => $_ENV["INSTAGRAM_LINK"],
            "facebook_link" => $_ENV["FACEBOOK_LINK"],
            "github_link" => $_ENV["GITHUB_LINK"],
            "website_link" => $_ENV["WEBSITE_LINK"],
        ];
    }

    public function base_url($url = "")
    {
        if (preg_match("/^\//", $url)) {
            $url = preg_replace("/^\//", "", $url);
        }
        return $this->host . $url;
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
