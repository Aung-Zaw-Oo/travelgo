<?php

session_start();

require_once '../models/Auth.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
                $_SESSION['error'] = "Please fill in all fields!";
                header("Location: ../views/register.php");
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Invalid email format!";
                header("Location: ../views/register.php");
                exit();
            }

            if (strlen($password) < 6) {
                $_SESSION['error'] = "Password must be at least 6 characters!";
                header("Location: ../views/register.php");
                exit();
            }

            if ($password !== $confirm_password) {
                $_SESSION['error'] = "Passwords do not match!";
                header("Location: ../views/register.php");
                exit();
            }

            $auth = new Auth();
            if ($auth->emailExists($email)) {
                $_SESSION['error'] = "Email already exists!";
                header("Location: ../views/register.php");
                exit();
            }

            $auth->register($name, $email, $password);

            $_SESSION['success'] = "Registration successful! Please log in.";
            header("Location: ../views/login.php");
            exit();
        }
        break;



    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            // Basic Validation
            if (empty($email) || empty($password)) {
                $_SESSION['error'] = "Please fill in all fields!";
                header("Location: ../views/login.php");
                exit();
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Invalid email format!";
                header("Location: ../views/login.php");
                exit();
            }

            $auth = new Auth();
            $error = $auth->login($email, $password);

            if ($error) {
                $_SESSION['error'] = $error;
                header("Location: ../views/login.php");
                exit();
            }
        }
        break;

    case 'logout':
        $auth = new Auth();
        $auth->logout();
        exit();

    default:
        header('Location: ../index.php');
        exit();
}
