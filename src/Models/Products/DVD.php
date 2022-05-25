<?php

namespace Nedius\Models\Products;

use Nedius\Models\Product;

class DVD extends Product implements ProductInterface {
    public function validateType($description) {
        $bookRule = "/^(((\d+)|(\d+(\.|\,)\d+))\sMB)$/";

        return preg_match($bookRule, $description);
    }
}