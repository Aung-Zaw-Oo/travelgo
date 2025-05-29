<?php

require_once '../models/Auth.php';

$action = $_GET['action'];

switch ($action) {
    case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $auth = new Auth();
            $auth->register($name, $email, $password);
        }
        header('Location: ../index.php?action=login');
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $auth = new Auth();
            $error = $auth->login($email, $password);

            if ($error) {
                echo "<p style='color:red;'>$error</p>";
            }
        }
        break;

    case 'logout':
        $auth = new Auth();
        $auth->logout();
        break;

        // default:
        //     header('Location: ../index.php');
        //     break;
}
