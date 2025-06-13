<?php

session_start();
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

        if ($user) {
            if (password_verify($password, $user['password'])) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                header('Location: ../views/home.php');
                exit();
            } else {
                return "Invalid Email or Password";
            }
        } else {
            return "Invalid Email or Password";
        }
    }


    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../views/login.php');
        exit();
    }

    public static function checkAdmin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: ../views/login.php');
            exit();
        }
    }

    public function emailExists($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function updateProfile($id, $name, $email, $password = null)
    {
        $query = "UPDATE users SET name = :name, email = :email";
        if (!empty($password)) {
            $query .= ", password = :password";
        }
        $query .= " WHERE id = :id";

        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);

        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(':password', $hashedPassword);
        }

        return $stmt->execute();
    }
}
