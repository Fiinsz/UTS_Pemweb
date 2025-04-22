<?php
// filepath: c:\laragon\www\UTS_pemweb\includes\db.php

class Database {
    private $host = "127.0.0.1";
    private $port = "3306";
    private $dbname = "uts_pemweb";
    private $username = "root";
    private $password = "";
    public $conn;

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
?>