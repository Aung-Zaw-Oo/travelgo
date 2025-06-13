<?php
session_start();
require_once '../models/Auth.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($name) || empty($email)) {
        $_SESSION['error'] = "Name and Email are required.";
        header('Location: ../views/profile.php');
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header('Location: ../views/profile.php');
        exit();
    }

    // Update profile
    $auth = new Auth();
    $success = $auth->updateProfile($id, $name, $email, $password);

    if ($success) {
        $_SESSION['success'] = "Profile updated successfully.";
        // Update session data
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['email'] = $email;
    } else {
        $_SESSION['error'] = "Failed to update profile.";
    }

    header('Location: ../views/profile.php');
    exit();
} else {
    header('Location: ../views/profile.php');
    exit();
}
