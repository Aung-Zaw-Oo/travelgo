<?php


$action = $_GET['action'] ?? 'default';
switch ($action) {
    case 'newsletter':
        header('Location: views/newsletter.php');
        break;

    case 'register':
        header('Location: views/register.php');
        break;

    case 'login':
        header('Location: views/login.php');
        break;

    case 'forgot':
        header('Location: views/forgot.php');
        break;

    default:
        header('Location: views/home.php');
        break;
}
