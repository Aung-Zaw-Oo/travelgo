<?php

$action = $_GET['action'] ?? 'default';
switch ($action) {
    case 'newsletter':
        header('Location: views/newsletter.php');
        exit();

    case 'manage_tickets':
        header('Location: views/manage_tickets.php');
        exit();

    case 'register':
        header('Location: views/register.php');
        exit();

    case 'login':
        header('Location: views/login.php');
        exit();

    case 'forgot':
        header('Location: views/forgot.php');
        exit();

    case 'manage_flights':
        header('Location: views/manage_flights.php');
        exit();

    case 'manage_users':
        header('Location: views/manage_users.php');
        exit();

    default:
        header('Location: views/home.php');
        exit();
}
