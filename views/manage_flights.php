<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

require_once '../models/Flight.php';
$flightModel = new Flight();
$flights = $flightModel->getAllFlights();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelGO | Manage Flights</title>
    <link rel="stylesheet" href="../includes/reset.css">
    <link rel="stylesheet" href="../includes/assets/css/manage_flights.css">
</head>

<body>

    <?php include '../includes/header.php'; ?>

    <main>
        <div class="container">
            <h1><i class="fa-solid fa-plane-departure"></i> Manage Flights</h1>
            <a href="add_flight.php" class="btn-add"><i class="fa-solid fa-plus"></i> Add New Flight</a>

            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Airline</th>
                        <th>Flight No.</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Departure</th>
                        <th>Arrival</th>
                        <th>Seats</th>
                        <th>Price ($)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($flights)): ?>
                        <?php foreach ($flights as $index => $flight): ?>
                            <tr>
                                <td data-label="#"> <?= $index + 1 ?></td>
                                <td data-label="Airline"><?= htmlspecialchars($flight['airline']) ?></td>
                                <td data-label="Flight No."><?= htmlspecialchars($flight['flight_number']) ?></td>
                                <td data-label="From"><?= htmlspecialchars($flight['origin']) ?></td>
                                <td data-label="To"><?= htmlspecialchars($flight['destination']) ?></td>
                                <td data-label="Departure"><?= htmlspecialchars($flight['departure_time']) ?></td>
                                <td data-label="Arrival"><?= htmlspecialchars($flight['arrival_time']) ?></td>
                                <td data-label="Seats"><?= htmlspecialchars($flight['available_seats']) ?></td>
                                <td data-label="Price"><?= htmlspecialchars($flight['price']) ?></td>
                                <td data-label="Actions" class="actions">
                                    <a href="edit_flight.php?id=<?= $flight['id'] ?>" class="btn-edit"><i class="fa-solid fa-pen"></i></a>
                                    <a href="../controllers/FlightController.php?action=delete&id=<?= $flight['id'] ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this flight?')"><i class="fa-solid fa-trash"></i></a>
                                </td>


                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" style="text-align:center;">No flights found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

</body>

</html>