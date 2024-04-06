<?php

class Database
{
    private $host = "localhost";
    private $database = "resumebuilder";
    private $username = "root";
    private $password = "";
    private $port = 3307;
    private $db = null;

    function __construct()
    {
        $this->db =  new mysqli($this->host, $this->username, $this->password, $this->database, $this->port);
    }

    public function connect(){
        return $this->db;
    }
}

$db_connection = new Database();
$db = $db_connection->connect();
