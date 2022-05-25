<?php

namespace Nedius\Models\Products;

use Nedius\Models\Product;

class Furniture extends Product implements ProductInterface {
    public function validateType($description) {
        $bookRule = "/^(((\d+)|(\d+(\.|\,)\d+))x((\d+)|(\d+(\.|\,)\d+))x((\d+)|(\d+(\.|\,)\d+)))$/";

        return preg_match($bookRule, $description);
    }
}