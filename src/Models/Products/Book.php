<?php

namespace Nedius\Models\Products;

use Nedius\Models\Product;

class Book extends Product implements ProductInterface {
    public function validateType($description) {
        $bookRule = "/^(((\d+)|(\d+(\.|\,)\d+))\sKG)$/";

        return preg_match($bookRule, $description);
    }
}