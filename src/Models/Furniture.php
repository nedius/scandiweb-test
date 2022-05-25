<?php

namespace Nedius\Models;

class Furniture extends Products {
    public function validateType($description) {
        $bookRule = "/^(((\d+)|(\d+(\.|\,)\d+))x((\d+)|(\d+(\.|\,)\d+))x((\d+)|(\d+(\.|\,)\d+)))$/";

        return preg_match($bookRule, $description);
    }
}