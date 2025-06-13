<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

require_once '../models/Ticket.php';
$ticketModel = new Ticket();

if (!isset($_GET['id'])) {
    header('Location: manage_tickets.php');
    exit();
}

$ticketId = $_GET['id'];
$ticket = $ticketModel->getTicketById($ticketId);

if (!$ticket) {
    echo "Ticket not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelGO | Ticket Details</title>
    <link rel="stylesheet" href="../includes/reset.css">
    <link rel="stylesheet" href="../includes/assets/css/ticket_detail.css">
</head>

<body>
    <div class="container">
        <h1>Ticket Details</h1>

        <div class="detail-item"><span>Ticket Serial:</span> <?= htmlspecialchars($ticket['ticket_number']) ?></div>
        <div class="detail-item"><span>Passenger Name:</span> <?= htmlspecialchars($ticket['name']) ?></div>
        <div class="detail-item"><span>Email:</span> <?= htmlspecialchars($ticket['email']) ?></div>
        <div class="detail-item"><span>Passport:</span> <?= htmlspecialchars($ticket['passport']) ?></div>
        <div class="detail-item"><span>Flight Number:</span> <?= htmlspecialchars($ticket['flight_number']) ?></div>
        <div class="detail-item"><span>Origin:</span> <?= htmlspecialchars($ticket['origin']) ?></div>
        <div class="detail-item"><span>Destination:</span> <?= htmlspecialchars($ticket['destination']) ?></div>
        <div class="detail-item"><span>Departure Time:</span> <?= htmlspecialchars($ticket['departure_time']) ?></div>
        <div class="detail-item"><span>Arrival Time:</span> <?= htmlspecialchars($ticket['arrival_time']) ?></div>
        <div class="detail-item"><span>Seat:</span> <?= htmlspecialchars($ticket['seat']) ?></div>
        <div class="detail-item"><span>Price:</span> $<?= htmlspecialchars($ticket['price']) ?></div>

        <a href="manage_tickets.php" class="btn-back">Back to Tickets</a>
    </div>
</body>

</html>