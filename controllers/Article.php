<?php

namespace Controller;

use Controller\Base;

class Article extends Base
{
    public function index($param)
    {
        $slug = $param["slug"];
        $path = __DIR__ . "/../articles/$slug.json";

        if (!file_exists($path)) {
            header("location : " . $this->base_url("404"));
            return;
        }

        $article = json_decode(file_get_contents($path), true);

        $this->template("article.html", ["page_title" => $article["title"], "article" => $article]);
    }
}
