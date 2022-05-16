<?php

namespace Nedius\Controllers;

use Nedius\Core\ResponseProvider;

class HomeController {

    public static function home() {
        ResponseProvider::getPublicFile("home.html");
    }

    public static function add() {
        ResponseProvider::getPublicFile("add.html");
    }

}