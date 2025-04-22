<?php
// filepath: c:\laragon\www\UTS_pemweb\includes\auth.php
require_once 'db.php';

class Auth {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($username, $password) {
        $query = "SELECT * FROM author WHERE nickname = :nickname AND password = :password";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nickname', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>