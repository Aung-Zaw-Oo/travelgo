<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../index.php?action=login');
    exit();
}

require_once '../models/Flight.php';

if (!isset($_GET['flight_id'])) {
    header('Location: index.php');
    exit();
}

$flightModel = new Flight();
$flight = $flightModel->getFlightById($_GET['flight_id']);

if (!$flight) {
    echo "Flight not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Flight</title>
    <link rel="stylesheet" href="../includes/reset.css">
    <link rel="stylesheet" href="../includes/assets/css/book_flight.css">
</head>
<body>

    <?php include '../includes/header.php' ?>

    <main>
        <div class="container">
            <div>
                <h1>Booking Flight: <?= htmlspecialchars($flight['airline']) . ' ' . htmlspecialchars($flight['flight_number']) ?></h1>
            </div>
            <div>
                <p>From <?= htmlspecialchars($flight['origin']) ?> to <?= htmlspecialchars($flight['destination']) ?></p>
            </div>
            <div>
                <p>Departure: <?= date('Y-m-d H:i', strtotime($flight['departure_time'])) ?></p>
            </div>
            <div>
                <p>Arrival: <?= date('Y-m-d H:i', strtotime($flight['arrival_time'])) ?></p>
            </div>
            <div>
                <p>Price: $<?= htmlspecialchars($flight['price']) ?></p>
            </div>

        </div>

        <div class="container">

            <form method="POST" action="confirm_booking.php">
                <input type="hidden" name="flight_id" value="<?= $flight['id'] ?>">

                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required value="<?= htmlspecialchars($_SESSION['user']['name']) ?>">

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required value="<?= htmlspecialchars($_SESSION['user']['email']) ?>">

                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" required>

                <label for="passport">Passport Number</label>
                <input type="text" id="passport" name="passport" required>

                <label for="payment_method">Payment Method</label>
                <select id="payment_method" name="payment_method" required>
                    <option value="">--Select Payment--</option>
                    <option value="credit_card">Credit/Debit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="wavepay">WavePay</option>
                    <option value="kbzpay">KBZPay</option>
                </select>

                <div id="payment-fields">

                </div>

                <button type="submit" class="btn-submit"><i class="fa-solid fa-check"></i> Confirm Booking</button>
                <a href="manage_flights.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Back</a>

            </form>
        </div>
    </main>

    <?php include '../includes/footer.php' ?>

    <script>
        const paymentSelect = document.getElementById('payment_method');
        const paymentFields = document.getElementById('payment-fields');

        paymentSelect.addEventListener('change', function() {
            paymentFields.innerHTML = ''; // Reset

            if (this.value === 'credit_card') {
                paymentFields.innerHTML = `
                <div class="payment-info">
                    <label for="card_number">Card Number</label>
                    <input type="text" name="card_number" id="card_number" required>
                </div>
                <div class="payment-info">
                <label for="expiry_date">Expiry Date</label>
                        <input type="month" name="expiry_date" id="expiry_date" required>
                </div>
                <div class="payment-info">
                    <label for="cvv">CVV</label>
                    <input type="text" name="cvv" id="cvv" required>
                </div>
                `;
            } else if (this.value === 'paypal') {
                paymentFields.innerHTML = `
                <div class="payment-info">
                <label for="paypal_email">PayPal Email</label>
                <input type="email" name="paypal_email" id="paypal_email" required>
                </div>
                `;
            } else if (this.value === 'wavepay' || this.value === 'kbzpay') {
                paymentFields.innerHTML = `
                <div class="payment-info">
                    <label for="wallet_id">Wallet ID / Phone Number</label>
                    <input type="text" name="wallet_id" id="wallet_id" required>
                </div>
                `;
            }
        });
    </script>
</body>

</html>