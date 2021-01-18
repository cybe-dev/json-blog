<?php
namespace Controller;

class Api
{
    public function verify($param, $position, $next)
    {
        if (!isset($_SERVER["PHP_AUTH_USER"]) || !isset($_SERVER["PHP_AUTH_PW"])) {
            $this->error("Unauthorized", 401);
        } else {

            $user = $_SERVER["PHP_AUTH_USER"];
            $pw = $_SERVER["PHP_AUTH_PW"];

            if (!(($user == $_ENV["AUTH_USER"]) && ($pw == $_ENV["AUTH_PASS"]))) {
                $this->error("Unauthorized", 401);
            } else {
                $next($param, $position);
            }
        }

    }

    private function error($message, $status_code = 400)
    {
        http_response_code($status_code);
        echo json_encode(["error" => $message]);
    }

    public function post()
    {
        header("Content-Type: application/json");

        if (!isset($_FILES["article"])) {
            $this->error("You not uploaded article json file");
            return;
        }

        $tmp_name = $_FILES["article"]["tmp_name"];
        $filename = $_FILES["article"]["name"];

        if (!preg_match("/\.json$/", $filename)) {
            $this->error("File is not a json");
            return;
        }

        move_uploaded_file($tmp_name, __DIR__ . "/../articles/$filename");

        echo json_encode(["message" => "Article has uploaded"]);
    }

    public function destroy($param)
    {
        header("Content-Type: application/json");

        $slug = $param["slug"];
        $path = __DIR__ . "/../articles/$slug.json";

        if (!file_exists($path)) {
            $this->error("File not found", 404);
            return;
        }

        unlink($path);
        echo json_encode(["message" => "Article has deleted"]);
    }
}
