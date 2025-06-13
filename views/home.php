<?php
require_once '../models/Flight.php';

$flightModel = new Flight();

if (isset($_GET['origin']) || isset($_GET['destination']) || isset($_GET['date'])) {
    $origin = $_GET['origin'] ?? '';
    $destination = $_GET['destination'] ?? '';
    $date = $_GET['date'] ?? '';
    $flights = $flightModel->searchFlights($origin, $destination, $date);
} else {
    $flights = $flightModel->getAllFlights();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelGO | Home</title>
    <link rel="stylesheet" href="../includes/reset.css">
    <link rel="stylesheet" href="../includes/assets/css/home.css">
</head>

<body>

    <?php
    include "../includes/header.php";
    ?>

    <main>
        <section class="search-bar">
            <form action="home.php" method="GET" class="search-form">
                <input type="text" name="origin" placeholder="From (City/Airport)" value="<?= isset($_GET['origin']) ? htmlspecialchars($_GET['origin']) : '' ?>">
                <input type="text" name="destination" placeholder="To (City/Airport)" value="<?= isset($_GET['destination']) ? htmlspecialchars($_GET['destination']) : '' ?>">
                <input type="date" name="date" value="<?= isset($_GET['date']) ? htmlspecialchars($_GET['date']) : '' ?>">
                <button type="submit"><i class="fas fa-search"></i> Search Flights</button>
            </form>
        </section>


        <section class="flights-list">
            <h2><i class="fas fa-plane"></i> Available Flights</h2>

            <?php if (count($flights) === 0): ?>
                <p>No flights available.</p>
            <?php else: ?>
                <?php foreach ($flights as $flight): ?>
                    <div class="flight-item">
                        <div><i class="fas fa-building"></i> <?= htmlspecialchars($flight['airline']) ?></div>
                        <div><i class="fas fa-plane-departure"></i> <?= htmlspecialchars($flight['origin']) ?></div>
                        <div><i class="fas fa-plane-arrival"></i> <?= htmlspecialchars($flight['destination']) ?></div>
                        <div><i class="far fa-clock"></i>
                            <?= date('h:i A', strtotime($flight['departure_time'])) ?> - <?= date('h:i A', strtotime($flight['arrival_time'])) ?>
                        </div>
                        <div class="flight-price"><i class="fa-solid fa-dollar-sign"></i> <?= htmlspecialchars($flight['price']) ?></div>
                        <form method="GET" action="book_flight.php" style="display:inline;">
                            <input type="hidden" name="flight_id" value="<?= $flight['id'] ?>">
                            <button class="book-btn" type="submit"><i class="fas fa-ticket-alt"></i> Book Now</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>

    <?php
    include "../includes/footer.php";
    ?>

</body>

</html>