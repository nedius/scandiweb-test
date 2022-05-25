<?php

namespace Nedius\Models;

use Nedius\Core\Model;

abstract class Products extends Model {
    
    function __construct() {
        parent::__construct('products');
        
        $this->setRows([
            'sku' => 'required|string|not_null|min:1|max:255',
            'name' => 'required|string|not_null|min:1|max:255',
            'price' => 'required|numericORfloat|not_null|min:0',
            'type' => 'required|string|not_null|min:1|max:255',
            'description' => 'required|string|not_null'
        ]);
        $this->setPrimaryKey('sku');
    }

    abstract public function validateType($description);
}