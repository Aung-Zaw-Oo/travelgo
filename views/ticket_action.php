<?php

require_once '../controllers/TicketController.php';

$controller = new TicketController();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id = $_GET['id'] ?? null;

    if ($action === 'approve' && $id) {
        $controller->approve($id);
    } elseif ($action === 'decline' && $id) {
        $controller->decline($id);
    } elseif ($action === 'delete' && $id) {
        $controller->delete($id);
    } elseif ($action === 'detail' && $id) {
        $controller->detail($id);
    } else {
        $tickets = $controller->index();
        require_once '../views/manage_tickets.php';
    }
}
