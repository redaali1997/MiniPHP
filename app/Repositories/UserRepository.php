<?php
namespace App\Repositories;

use App\Database;
use App\Interfaces\UserRepositoryInterface;
use PDO;

class UserRepository implements UserRepositoryInterface {
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(string $name, string $email)
    {
        $query = "INSERT INTO users (name, email) VALUES (:name,:email)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }
}