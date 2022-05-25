<?php

namespace Nedius\Models;

use Nedius\Core\Model;
use Nedius\Core\Validate;
use Nedius\Core\ResponseProvider;

class Product extends Model {

    private $rules = [
        'sku' => 'required|string|not_null|min:1|max:255',
        'name' => 'required|string|not_null|min:1|max:255',
        'price' => 'required|numericORfloat|not_null|min:0',
        'type' => 'required|string|not_null|min:1|max:255',
        'description' => 'required|string|not_null'
    ];
    
    public function __construct() {
        parent::__construct('products');

        $this->setRows($this->rules);
        $this->setPrimaryKey('sku');
    }
}