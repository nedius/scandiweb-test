<?php

namespace Nedius\Core;

class Query extends Database {

    private $tableName;
    private $sql;
    private $stmt;
    private $data = array();

    function __construct($tableName) {
        parent::__construct();

        $this->tableName = $tableName;
    }

    protected function select(...$columns) {
        $this->sql = 'SELECT '.implode(',', $columns).' FROM '.$this->tableName;
        return $this;
    }

    protected function where($column, $operator, $value){
        $this->data[] = $value;
        $this->sql .= ' WHERE '.$column.' '.$operator.' ?';
        return $this;
    }

    protected function and($column, $operator, $value) {
        $this->data[] = $value;
        $this->sql .= ' AND '.$column.' '.$operator.' ?';
        return $this;
    }

    protected function or($column, $operator, $value) {
        $this->data[] = $value;
        $this->sql .= ' OR '.$column.' '.$operator.' ?';
        return $this;
    }

    protected function delete($column, $operator, $value) {
        $this->sql = 'DELETE FROM '.$this->tableName;
        $this->where($column, '=', $value);

        return $this->bind();
    }

    protected function insert(...$data){
        $this->data = array_merge($this->data, $data);
        $this->sql = 'INSERT INTO '.$this->tableName.' VALUES ('.implode(',', array_fill(0, count($data), '?')).')';

        return $this->bind();
    }

    // public function update($column, $operator, $value) {
    //     $this->sql = 'UPDATE '.$this->tableName.' SET '.$column.' '.$operator.' ?';
    //     $this->data[] = $value;

    //     return $this->bind();
    // }

    private function bind() {
        $this->stmt = $this->connection->prepare($this->sql);

        if($this->data != null){
            $params = array();
            $params[] = $this->getTypes();
            $params = array_merge($params, $this->data);

            $this->stmt->bind_param(...$params);
        }
        
        $this->data = array();
        $this->stmt->execute();
        return $this->stmt;
    }

    protected function execute() {
        return mysqli_fetch_all($this->bind()->get_result(), MYSQLI_ASSOC);
    }

    private function getTypes() {
        $types = '';

        foreach ($this->data as $key => $value) {
            $types .= $this->getDataType($value);
        }
        
        return $types;
    }

    private function getDataType($data) {
        switch (gettype($data)) {
            case 'string':
                return 's';
            case 'double':
                return 'd';
            case 'integer':
                return 'i';

            default:
                return 's';
        }
    }
    
}