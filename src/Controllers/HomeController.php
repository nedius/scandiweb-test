<?php

namespace Nedius\Controllers;

use Nedius\Core\ResponseProvider;

class HomeController {

    public static function home() {
        ResponseProvider::getView("productList");
    }

    public static function add() {
        ResponseProvider::getView("addProduct");
    }

}