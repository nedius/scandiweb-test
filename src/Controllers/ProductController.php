<?php

namespace Nedius\Controllers;

use Nedius\Core\ResponseProvider;
use Nedius\Core\Query;
use Nedius\Models\Product;

class ProductController{

    public static function get() {
        // ResponseProvider::json((new Product)->all());
        ResponseProvider::json((new Query("products"))->select("*")->get());
    }

    public static function add() {
        // ResponseProvider::getPublicFile("add.html");
    }

    public static function delete() {
        // ResponseProvider::getPublicFile("delete.html");
    }

}