<?php

namespace Nedius\Models;

use Nedius\Core\Query;
use Nedius\Core\Validate;
use Nedius\Core\ResponseProvider;

class Product extends Query {

    private $tableName = "products";

    private $sku;
    private $name;
    private $price;
    private $type;
    private $description;
    
    public function __construct($data = array()) {
        parent::__construct($this->tableName);

        if(empty($data)) {
            return;
        }

        $rules = [
            "sku" => "required|string|max:255",
            "name" => "required|string|max:255",
            "price" => "required|numeric",
            "type" => "required|string|max:255",
            "description" => "required|string|max:255"
        ];

        $errors = Validate::validate($data, $rules);

        if(empty($errors)) {
            $this->sku = $data["sku"];
            $this->name = $data["name"];
            $this->price = $data["price"];
            $this->type = $data["type"];
            $this->description = $data["description"];
            $this->valid = true;
        } else {
            return ResponseProvider::error(400);
        }
    }

    public function all() {
        return $this->select("*")->get();
    }

    public function find($sku) {
        return $this->select("*")->where("sku", "=", $sku)->get();
    }

    public function save() {
        if(!$this->find($this->sku)){
            return $this->insert($this->sku, $this->name, $this->price, $this->type, $this->description);
        } else {
            return ResponseProvider::json(array('status' => 'danger', 'message' => 'Product already exists'));
        }
    }

    public function toArray() {
        return array(
            "sku" => $this->sku,
            "name" => $this->name,
            "price" => $this->price,
            "type" => $this->type,
            "description" => $this->description
        );
    }

    public function validate(...$data) {

    }
}