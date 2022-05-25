<?php

namespace Nedius\Models;

class DVD extends Products {
    public function validateType($description) {
        $bookRule = "/^(((\d+)|(\d+(\.|\,)\d+))\sMB)$/";

        return preg_match($bookRule, $description);
    }
}