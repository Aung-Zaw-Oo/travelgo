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
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .ticket {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            width: 90%;
            max-width: 600px;
        }

        .ticket-header {
            text-align: center;
            border-bottom: 2px dashed #ddd;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .ticket-header h1 {
            margin: 0;
            font-size: 2rem;
            color: #0072ff;
        }

        .ticket-details p {
            margin: 0.5rem 0;
            font-size: 1rem;
            color: #333;
        }

        .ticket-details p strong {
            color: #0072ff;
        }

        .ticket-number {
            font-size: 1.2rem;
            font-weight: bold;
            color: #ff5722;
            margin-top: 1rem;
        }

        .ticket-footer {
            text-align: center;
            margin-top: 2rem;
            border-top: 1px solid #ddd;
            padding-top: 1rem;
            font-size: 0.9rem;
            color: #666;
        }

        .ticket-footer p {
            margin: 0.3rem 0;
        }

        .home-link {
            display: inline-block;
            margin-top: 1.5rem;
            padding: 0.5rem 1rem;
            background: #0072ff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .home-link:hover {
            background: #0056b3;
        }
    </style>
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