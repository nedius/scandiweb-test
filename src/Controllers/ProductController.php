<?php

namespace Nedius\Controllers;

use Nedius\Core\ResponseProvider;
use Nedius\Core\Query;
use Nedius\Models\Product;

class ProductController{

    public static function get() { 
        $products = (new Product)->all();
        $output = array();

        foreach($products as $product) {
            $output[] = $product->toArray();
        }

        ResponseProvider::json($output);
    }

    public static function add($data) {
        // no if-else or switch-case here, just autoload magic :sparkles:
        $productType = 'Nedius\\Models\\' . $data['type'];

        if(!class_exists($productType)) {
            ResponseProvider::json(array('status' => 'danger', 'message' => 'Invalid type'));
            return false;
        }

        $product = new $productType;

        if($product->validateType($data['description']) == false) {
            ResponseProvider::json(array('status' => 'danger', 'message' => 'Invalid description'));
            return false;
        }

        $errors = $product->push($data);

        if(empty($errors)) {
            ResponseProvider::json(array('status' => 'success', 'message' => 'Product added'));
        } else {
            ResponseProvider::json(array('status' => 'danger', 'message' => 'There was error while creating product', 'errors' => $errors));
        }
    }

    public static function delete($data) {
        ResponseProvider::json(array('status' => 'success', 'message' => (new Product)->remove($data) . ' products deleted'));
    }

}