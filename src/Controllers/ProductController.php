<?php

namespace Nedius\Controllers;

use Nedius\Core\ResponseProvider;
use Nedius\Core\Query;
use Nedius\Models\Product;

class ProductController{

    public static function get() {
        ResponseProvider::json((new Product)->all());
    }

    public static function add($data) {
        $product = new Product($data);
        if($product->save()){
            ResponseProvider::json(array('status' => 'success', 'message' => 'Product added'));
        }
    }

    public static function delete($data) {
        foreach($data as $product) {
            (new Product)->delete("sku", "=", $product);
        }
        ResponseProvider::json(array('status' => 'success', 'message' => count($data) . ' products deleted'));
    }

}