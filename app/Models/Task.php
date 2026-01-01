<?php
namespace App\Models;

use App\Database;
use PDO;

class Task {
    private $conn;
    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAllTasks() {
        $query = "SELECT * FROM tasks ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(string $title) {
        $query = 'INSERT INTO tasks (title) VALUES (:title)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);

        if($stmt->execute()) {
            return $this->conn->lastInsertId();
        }

        return false;
    }

    public function update(int $id, bool $isCompleted) {
        $query = "UPDATE tasks SET is_completed = :is_completed WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':is_completed', $isCompleted);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM tasks WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}