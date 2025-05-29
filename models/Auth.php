<?php

class Auth
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function register($email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();
    }
}
