<?php

namespace Nedius\Core;

use Nedius\Core\Validate;

class Model extends Query{

    private $tableName;
    private $rows = array();
    private $primaryKey;
    private $_data = array();

    function __construct($tableName = null) {
        if(!is_null($tableName)) {
            $this->tableName = $tableName;
        }else{
            // can't pass array to end() without reference
            $childClassPath = explode('\\', get_called_class());
            $this->tableName = lcfirst(end($childClassPath)) . 's';
        }
        parent::__construct($this->tableName);
    }

    private function setRows($rows) {
        $this->rows = $rows;

        foreach ($rows as $key => $value) {
            $this->_data[$key] = null;
        }
    }

    private function setPrimaryKey($primary) {
        $this->primaryKey = $primary;
    }

    public function __call($method, $parameters){
        if(method_exists($this, $method)){
            return call_user_func_array(array($this, $method), $parameters);
        } elseif (substr($method, 0, 3) == 'get'){
            return $this->_get(lcfirst(substr($method, 3)));
        } elseif (substr($method, 0, 3) == 'set'){
            return $this->_get(lcfirst(substr($method, 3)), $parameters[0]);
        }

        throw new \Error('Call to undefined method ' . get_called_class() . '->' . $method . '(' . gettype($parameters) . ')');
    }

    private function _get($column) {
        if(isset($this->_data[$column]) && $this->_data[$column] !== null){
            return $this->_data[$column];
        } else {
            return null;
        }
    }

    private function _set($column, $value, $validate = true) {
        $errors = array();
        if($validate){
            $errors = $this->validate([ $column => $value ], [ $column => $this->rows[$column] ]);
        }

        if(empty($errors)){
            $this->_data[$column] = $value;
            return;
        }

        return $errors;
    }

    private function validate($data = null, $rules = null) {
        if($data === null && $rules === null){
            $errors = [];
            foreach($this->rows as $key => $value){
                $error = Validate::validate([ $key => $this->_data[$key] ], [ $key => $this->rows[$key] ]);
                if(!empty($error)){
                    $errors[$key] = $error;
                }
            }

            return $errors;
        }

        return Validate::validate($data, $rules);
    }

    public function toArray() {
        $array = array();

        if(empty($this->_data)){
            return $array;
        }
    
        foreach($this->rows as $key => $value) {
            $array[$key] = $this->_get($key);
        }

        return $array;
    }
    
    public function all() {
        $result = $this->select("*")->execute();
        $array = array();
        $class = get_called_class();
        
        foreach($result as $row) {
            $obj = new $class();
            $obj->load($row, false);
            $array[] = $obj;
        }


        return $array;
    }

    public function pull($id) {
        $data = $this->select("*")->where($this->primaryKey, '=', $id)->execute();
        
        $errors = $this->load($data, false);

        if(!empty($errors)){
            return false;
        }

        return $this;
    }

    public function remove(...$ids) {
        if($this->arrayInArray($ids)){
            $ids = $ids[0];
        }
        $count = 0;
        foreach($ids as $id) {
            $count += $this->delete("sku", "=", $id)->affected_rows;
        }

        return $count;
    }

    private function arrayInArray($arr){
        foreach($arr as $value){
            if(is_array($value)){
                return true;
            }
        }
        return false;
    }

    public function load($data, $validate = true) {
        $errors = array();

        foreach($data as $key => $value) {
            $error = $this->_set($key, $value, $validate);
            if($error !== null){
                $errors[$key] = $error;
            }
        }

        if(!empty($errors)){
            return $errors;
        }

        return [];
    }

    public function push($data) {
        $this->load($data, false);
        $errors = $this->validate();
        
        if(!$this->keyIsUnique($data[$this->primaryKey])){
            $error = "The $this->primaryKey must be unique";
            if(isset($errors[$this->primaryKey])){
                $errors[$this->primaryKey][] = $error;
            } else {
                $errors[$this->primaryKey] = [$error];
            }
        }

        if(!empty($errors)){
            return $errors;
        } else {
            $this->insert(...array_values($this->toArray()));
            return [];
        }
    }

    private function keyIsUnique($key){
        $data = $this->select("*")->where($this->primaryKey, '=', $key)->execute();
        if(!empty($data)){
            return false;
        }
        return true;
    }

}