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
        $product = new Product;
        if($product->validate($data) && $product->save()) {
            ResponseProvider::json(array('status' => 'success', 'message' => 'Product added'));
        }
    }

    public static function delete($data) {
        $count = 0;
        foreach($data as $product) {
            $count += (new Product)->delete("sku", "=", $product)->affected_rows;
        }
        ResponseProvider::json(array('status' => 'success', 'message' => $count . ' products deleted'));
    }

}