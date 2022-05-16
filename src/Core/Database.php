<?php

namespace Nedius\Core;

use mysqli;

class Database{

    protected $connection;

    function __construct() {
        $this->connection = new mysqli(DBHOST, DBUSER, DBPASSWORD, DBNAME, DBPORT);
        if ($this->connection->connect_error) {
            die("Failed to connect: " . $this->connection->connect_error);
        }
    }

    public function __destruct() {
        $this->connection->close();
    }

}