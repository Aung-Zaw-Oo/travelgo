<?php
require_once '../config/database.php';

class User
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function createUser($name, $email, $password, $role)
    {
        $sql = "INSERT INTO users (name, email, password, role, created_at) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $email, $password, $role]);
    }



    // Get all users
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get user by id
    public function getUserById($id)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user WITHOUT password
    public function updateUser($id, $name, $email, $role)
    {
        $sql = "UPDATE users SET name = :name, email = :email, role = :role WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'id' => $id
        ]);
    }

    // Update user WITH password
    public function updateUserWithPassword($id, $name, $email, $role, $password)
    {
        $sql = "UPDATE users SET name = :name, email = :email, role = :role, password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'password' => $password,
            'id' => $id
        ]);
    }


    // Delete user
    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
