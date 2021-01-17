<?php

namespace Controller;

use Controller\Base;

class Home extends Base
{
    public function index($param)
    {
        $get_article = array_diff(scandir("../articles"), array('..', '.'));
        $articles = [];
        $article_slug = [];
        $article_list = [];
        foreach ($get_article as $article) {
            if (preg_match("/\.json$/", $article)) {
                $slug = preg_replace("/\.json$/", "", $article);
                $article_json = json_decode(file_get_contents("../articles/$article"), true);
                $article_publish_date = $article_json["publish_date"];
                $articles[$slug] = array_merge($article_json, ["slug" => $slug]);
                $article_slug[$slug] = $article_publish_date;
            }
        }

        arsort($article_slug);
        $article_list = array_keys($article_slug);

        $this->template("index.html", ["page_title" => "Akbar Aditama", "article_list" => $article_list, "articles" => $articles]);
    }
}
