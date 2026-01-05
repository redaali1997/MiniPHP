<?php
namespace App\Interfaces;

interface UserRepositoryInterface {
    public function getAllUsers();

    public function create(string $name, string $email);
}