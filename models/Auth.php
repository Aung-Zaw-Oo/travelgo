<?php

require_once '../config/database.php';

class Auth
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function register($name, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();
    }

    public function login($email, $password)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];
            header('Location: ../index.php');
            exit();
        } else {
            $error = "Invalid Email or Password";
            return $error;
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../index.php');
        exit();
    }
}
