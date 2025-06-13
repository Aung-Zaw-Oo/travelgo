<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
?>

<?php
/**
 * Get Flight By ID
 * @return array<int, array<string, mixed>>
 */

require_once '../models/Flight.php';
$flightModel = new Flight();
$flightData = $flightModel->getFlightById($_GET['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Flight</title>
    <link rel="stylesheet" href="../includes/reset.css">
    <link rel="stylesheet" href="../includes/assets/css/edit_flight.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php include '../includes/header.php'; ?>

    <main>
        <div class="container">
            <h1><i class="fa-solid fa-pen-to-square"></i> Edit Flight</h1>
            <form action="../controllers/FlightController.php?action=edit" method="post">
                <input type="hidden" name="id" value="<?= htmlspecialchars($flightData['id']) ?>">

                <div class="form-group">
                    <label for="airline"><i class="fa-solid fa-plane"></i> Airline</label>
                    <input type="text" id="airline" name="airline" placeholder="e.g., Emirates" required value="<?= htmlspecialchars($flightData['airline']) ?>">
                </div>

                <div class="form-group">
                    <label for="flight_number"><i class="fa-solid fa-hashtag"></i> Flight Number</label>
                    <input type="text" id="flight_number" name="flight_number" placeholder="e.g., EK123" required value="<?= htmlspecialchars($flightData['flight_number']) ?>">
                </div>

                <div class="form-group">
                    <label for="origin"><i class="fa-solid fa-plane-departure"></i> Origin</label>
                    <input type="text" id="origin" name="origin" placeholder="e.g., Dubai" required value="<?= htmlspecialchars($flightData['origin']) ?>">
                </div>

                <div class="form-group">
                    <label for="destination"><i class="fa-solid fa-plane-arrival"></i> Destination</label>
                    <input type="text" id="destination" name="destination" placeholder="e.g., London" required value="<?= htmlspecialchars($flightData['destination']) ?>">
                </div>

                <div class="form-group">
                    <label for="departure_time"><i class="fa-solid fa-clock"></i> Departure Time</label>
                    <input type="datetime-local" id="departure_time" name="departure_time" required value="<?= date('Y-m-d\TH:i', strtotime($flightData['departure_time'])) ?>">
                </div>

                <div class="form-group">
                    <label for="arrival_time"><i class="fa-solid fa-clock"></i> Arrival Time</label>
                    <input type="datetime-local" id="arrival_time" name="arrival_time" required value="<?= date('Y-m-d\TH:i', strtotime($flightData['arrival_time'])) ?>">
                </div>

                <div class="form-group">
                    <label for="available_seats"><i class="fa-solid fa-chair"></i> Available Seats</label>
                    <input type="number" id="available_seats" name="available_seats" placeholder="e.g., 180" min="1" required value="<?= htmlspecialchars($flightData['available_seats']) ?>">
                </div>

                <div class="form-group">
                    <label for="price"><i class="fa-solid fa-dollar-sign"></i> Price ($)</label>
                    <input type="number" id="price" name="price" placeholder="e.g., 500" min="0" required value="<?= htmlspecialchars($flightData['price']) ?>">
                </div>

                <button type="submit" class="btn-submit"><i class="fa-solid fa-check"></i> Update Flight</button>
                <a href="manage_flights.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Back</a>
            </form>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

</body>

</html>