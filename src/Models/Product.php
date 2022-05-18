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
    
    public function __construct() {
        parent::__construct($this->tableName);
    }

    public function all() {
        return $this->select("*")->get();
    }

    public function find($sku) {
        return $this->select("*")->where("sku", "=", $sku)->get();
    }

    public function save() {
        if(isset($this->sku) && isset($this->name) && isset($this->price) && isset($this->type) && isset($this->description)) {
            if(!$this->find($this->sku)){
                return $this->insert($this->sku, $this->name, $this->price, $this->type, $this->description);
            } else {
                ResponseProvider::json(array('status' => 'danger', 'message' => 'Product already exists'));
                return false;
            }
        } else {
            return false;
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

    public function validate($data) {
        $rules = [
            "sku" => "required|string|max:255",
            "name" => "required|string|max:255",
            "price" => "required|numericORfloat",
            "type" => "required|string|max:255",
            "description" => "required|string|max:255"
        ];

        $errors = Validate::validate($data, $rules);

        if(!empty($errors) || $this->find($this->sku) || !$this->validateType($data["type"], $data["description"])) {
            ResponseProvider::json(array('status' => 'danger', 'message' => 'Product already exists or invalid'));
            return false;
        }

        $this->sku = $data["sku"];
        $this->name = $data["name"];
        $this->price = $data["price"];
        $this->type = $data["type"];
        $this->description = $data["description"];
        return true;
    }

    public function validateType($type, $description) {
        $types = [
            "DVD" => "/^(((\d+)|(\d+(\.|\,)\d+))\sMB)$/",
            "Book" => "/^(((\d+)|(\d+(\.|\,)\d+))\sKG)$/",
            "Furniture" => "/^(((\d+)|(\d+(\.|\,)\d+))x((\d+)|(\d+(\.|\,)\d+))x((\d+)|(\d+(\.|\,)\d+)))$/"
        ];

        return isset($types[$type]) && preg_match($types[$type], $description);
    }
}