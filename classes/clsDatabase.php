<?php

class clsDatabase
{
    private $host = "localhost";
    private $dbname = "Tasks";
    private $username = "user_Tasks";
    private $password = "user_Tasks";

    public $conn = null;

    function __construct()
    {
        $this->connect();
    }
    public function connect()
    {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $conn = null;
        }
    }
    public function getConnection()
    {
        return $this->conn;
    }
}
