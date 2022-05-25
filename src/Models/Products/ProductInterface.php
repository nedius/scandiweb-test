<?php

namespace Nedius\Models\Products;

interface ProductInterface {
    public function validateType($description);
}