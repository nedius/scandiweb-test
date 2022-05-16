<?php

namespace Nedius\Core;

class Router {

    private $paths = array();

    public function add($method, $path, $callback) {
        $this->paths[$method][$path] = $callback;
    }

    public function go($method, $path) {
        if (isset($this->paths[$method][$path])) {
            return call_user_func($this->paths[$method][$path]);
        } elseif($method == "GET") {
            ResponseProvider::getPublicFile($path);
            return;
        } else {
            ResponseProvider::json(array("error" => array( "code" => 403, "message" => "Forbidden" )));
        }
        return false;
    }

}