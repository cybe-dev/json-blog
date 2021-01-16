<?php

namespace Controller;

use Controller\Base;

class Home extends Base
{
    public function index()
    {
        $this->template("index.html", ["page_title" => "Akbar Aditama"]);
    }
}
