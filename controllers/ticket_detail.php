<?php
require_once 'TicketController.php';

$controller = new TicketController();
if (isset($_GET['id'])) {
    $controller->detail($_GET['id']);
} else {
    echo "No ticket ID provided.";
}
