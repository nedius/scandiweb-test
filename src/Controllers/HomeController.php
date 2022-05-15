<?php

namespace Nedius\Controllers;

class HomeController {

    public static function index() {
        echo "Hello World! <br> <a href=\"https://nedius.com\\cat.jpg\">click me</a>";
    }

    public static function show() {
        echo "Hello World! show";
    }

    public static function create() {
        echo "Hello World! create";
    }

    public static function delete() {
        echo "Hello World! delete";
    }

}