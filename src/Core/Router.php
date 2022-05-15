<?php

namespace Nedius\Core;

class Router {

    private $paths = array();

    // public function __construct() {
    //     // echo "Router is running";
    // }

    public function add($method, $path, $callback) {
        $this->paths[$method][$path] = $callback;
    }

    public function go($method, $path) {
        $publicPath = $_SERVER['DOCUMENT_ROOT'] . "/src/Public" . $path;
        $publicPath = str_replace('\\', '/', $publicPath);
        if (isset($this->paths[$method][$path])) {
            // return $this->paths[$method][$path];
            return call_user_func($this->paths[$method][$path]);
        } elseif(file_exists($publicPath)){
            header("Content-Type: " . mime_content_type($publicPath));
            return readfile($publicPath);
        } else {
            echo "404";
            return;
        }
        return false;
    }

}