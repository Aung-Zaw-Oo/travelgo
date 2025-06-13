<?php
session_start();
require_once '../models/Flight.php';
require_once '../models/Booking.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flightId = $_POST['flight_id'];
    $userId = $_SESSION['user']['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $passport = $_POST['passport'];
    $paymentMethod = $_POST['payment_method'];

    $flightModel = new Flight();
    $flight = $flightModel->getFlightById($flightId);

    if (!$flight) {
        echo "Flight not found.";
        exit();
    }

    $ticketNumber = $flight['flight_number'] . '-' . mt_rand(1000, 9999);

    $bookingModel = new Booking();
    $bookingId = $bookingModel->createBooking(
        $userId,
        $flightId,
        $name,
        $email,
        $phone,
        $passport,
        $paymentMethod,
        $ticketNumber
    );

    if (!$bookingId) {
        echo "Booking failed. Please try again.";
        exit();
    }

    $bookingDetails = $bookingModel->getBookingDetails($bookingId);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TravelGO | Booking Confirmation</title>
    <link rel="stylesheet" href="../includes/assets/css/confirm_booking.css">
</head>

<body>

    <div class="ticket">
        <div class="ticket-header">
            <h1>TravelGO</h1>
            <p>Your Journey Starts Here!</p>
        </div>

        <div class="ticket-details">
            <p><strong>Ticket Number:</strong> <?= htmlspecialchars($bookingDetails['ticket_number']) ?></p>
            <p><strong>Flight:</strong> <?= htmlspecialchars($bookingDetails['airline']) ?> (<?= htmlspecialchars($bookingDetails['flight_number']) ?>)</p>
            <p><strong>From:</strong> <?= htmlspecialchars($bookingDetails['origin']) ?> → <strong>To:</strong> <?= htmlspecialchars($bookingDetails['destination']) ?></p>
            <p><strong>Departure:</strong> <?= date('Y-m-d H:i', strtotime($bookingDetails['departure_time'])) ?></p>
            <p><strong>Passenger Name:</strong> <?= htmlspecialchars($bookingDetails['name']) ?></p>
            <p><strong>Passport Number:</strong> <?= htmlspecialchars($bookingDetails['passport']) ?></p>
            <p><strong>Payment Method:</strong> <?= htmlspecialchars(ucfirst($bookingDetails['payment_method'])) ?></p>
            <p class="ticket-number">Booking Confirmed!</p>
        </div>

        <a class="home-link" href="../index.php">Back to Home</a>

        <div class="ticket-footer">
            <p>Need help? Call our 24/7 hotline: <strong>+1 800 555 1234</strong></p>
            <p>Email: <strong>support@travelgo.com</strong></p>
            <p>Thank you for choosing TravelGO. Have a safe flight!</p>
        </div>
    </div>

</body>

</html>