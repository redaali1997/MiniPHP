<?php
namespace App\Repositories;

use App\Database;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use PDO;

class UserRepository implements UserRepositoryInterface
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAllUsers()
    {
        return User::all();
    }

    public function create(string $name, string $email)
    {
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->save();
    }
}