<?php
require_once '../models/Flight.php';

$flightModel = new Flight();
$flights = $flightModel->getAllFlights();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TravelGO | Home</title>
    <link rel="stylesheet" href="../includes/reset.css">
    <link rel="stylesheet" href="../includes/background.css">

    <style>
        main {
            width: 100%;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .search-bar {
            background: rgba(255, 255, 255, 0.6);
            padding: 1rem;
            border-radius: 8px;
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            justify-content: center;
            max-width: 900px;
            margin: 0 auto 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .search-bar input {
            padding: 0.7rem 1rem;
            border: 1px solid var(--primary-color);
            border-radius: 5px;
            flex: 1 1 150px;
            font-size: 0.95rem;
        }

        .search-bar button {
            padding: 0.7rem 1.2rem;
            background: var(--decent-color);
            color: var(--text-color);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background 0.3s;
        }

        .search-bar button:hover {
            background: var(--accent-color);
        }

        .flights-list {
            background: rgba(255, 255, 255, 0.6);
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: 0 auto;
        }

        .flights-list h2 {
            text-align: center;
            margin-bottom: 1rem;
            color: #f0a500;
        }

        .flight-item {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr auto auto;
            gap: 1rem;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }

        .flight-item:last-child {
            border-bottom: none;
        }

        .flight-item div i {
            margin-right: 0.3rem;
            color: #f0a500;
        }

        .flight-price i {
            color: #f0a500;
        }

        .book-btn {
            padding: 0.5rem 1rem;
            background: var(--decent-color);
            color: var(--text-color);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: .95rem;
            transition: background .3s;
        }

        .book-btn:hover {
            background: var(--accent-color);
        }

        @media (max-width: 600px) {
            .flights-list {
                display: grid;
                gap: 5px;
            }

            .flight-item {
                grid-template-columns: 1fr 1fr;
                gap: 0.5rem;
            }

            .flight-item div {
                text-align: left;
            }
        }
    </style>
</head>

<body>

    <?php
    include "../includes/header.php";
    ?>

    <main>
        <section class="search-bar">
            <form method="GET" action="index.php">
                <input type="text" name="airline" placeholder="Airline" value="<?= isset($_GET['airline']) ? htmlspecialchars($_GET['airline']) : '' ?>">
                <input type="text" name="origin" placeholder="From" value="<?= isset($_GET['origin']) ? htmlspecialchars($_GET['origin']) : '' ?>">
                <input type="text" name="destination" placeholder="To" value="<?= isset($_GET['destination']) ? htmlspecialchars($_GET['destination']) : '' ?>">
                <input type="date" name="departure_date" placeholder="Departure Date" value="<?= isset($_GET['departure_date']) ? htmlspecialchars($_GET['departure_date']) : '' ?>">
                <button type="submit"><i class="fas fa-search"></i> Search</button>
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