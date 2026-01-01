<?php
namespace App;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';
    private $db_name = 'miniphp';
    private $username = 'root';
    private $password = 'password';
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
            
            $this->conn = new PDO($dsn, $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->conn->exec('set names utf8');

        } catch(PDOException $e) {
            echo "خطأ في الاتصال: " . $e->getMessage();
        }

        return $this->conn;
    }

}