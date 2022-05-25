<?php

namespace Nedius\Models;

class Book extends Products {
    public function validateType($description) {
        $bookRule = "/^(((\d+)|(\d+(\.|\,)\d+))\sKG)$/";

        return preg_match($bookRule, $description);
    }
}