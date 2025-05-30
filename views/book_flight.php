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
    <style>
        main {
            background-color: #f7f9fc;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px 15px;
            color: #333;
        }

        .container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px 25px;
            margin: 20px 0;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Flight Info */
        .container h1 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #1d3557;
            text-align: center;
        }

        .container p {
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .container p span {
            font-weight: bold;
            color: #457b9d;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        form label {
            font-weight: bold;
            color: #1d3557;
            font-size: 0.95rem;
        }

        form input,
        form select {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            background-color: #fefefe;
            transition: border-color 0.3s;
        }

        form input:focus,
        form select:focus {
            border-color: #457b9d;
            outline: none;
        }

        #payment-fields {
            margin-top: 10px;
        }

        button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: var(--accent-color);
        }

        .btn-cancel {
            padding: 10px 15px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-cancel:hover {
            background-color: #cc0000;
        }


        .payment-info {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            .container h1 {
                font-size: 1.3rem;
            }

            form label {
                font-size: 0.9rem;
            }

            form input,
            form select {
                font-size: 0.95rem;
            }
        }
    </style>

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
                    <!-- for payment methods insertion -->
                </div>

                <button type="submit">Confirm Booking</button>
                <button type="button" onclick="history.back()" class="btn-cancel">Cancel</button>

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