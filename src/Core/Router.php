<?php

namespace Nedius\Core;

class Router {

    private $paths = array();

    public function add($method, $path, $callback) {
        $this->paths[$method][$path] = $callback;
    }

    public function go($method, $path) {
        if (isset($this->paths[$method][$path])) {
            if($method == "GET") {
                return call_user_func($this->paths[$method][$path]);
            } else {
                if(empty($_POST)){
                    return call_user_func($this->paths[$method][$path], json_decode(file_get_contents('php://input'), true));
                } else {
                    return call_user_func($this->paths[$method][$path], $_POST);
                }
            }
        } elseif($method == "GET") {
            ResponseProvider::getPublicFile($path);
            return;
        } else {
            ResponseProvider::error(403);
        }
        return false;
    }

}