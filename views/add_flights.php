<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Flight</title>
    <link rel="stylesheet" href="../includes/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        main {
            width: 100%;
        }

        .container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 0.4rem;
            color: var(--primary-color);
            font-weight: bold;
        }

        input {
            padding: 0.6rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        input:focus {
            border-color: var(--accent-color);
            outline: none;
        }

        .btn-submit,
        .btn-back {
            display: inline-block;
            text-align: center;
            padding: 0.75rem 1.2rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            color: #fff;
            background: #14213D;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-submit {
            background: #fca311;
            color: #000;
        }

        .btn-submit:hover {
            background: #e48f00;
        }

        .btn-back {
            background: #14213D;
        }

        .btn-back:hover {
            background: #0f1b2c;
        }

        @media (max-width: 500px) {
            .container {
                padding: 1rem;
            }

            input {
                font-size: 0.9rem;
            }

            .btn-submit,
            .btn-back {
                font-size: 0.9rem;
                padding: 0.5rem 1rem;
            }
        }
    </style>
</head>

<body>

    <?php include '../includes/header.php'; ?>

    <main>
        <div class="container">
            <h1><i class="fa-solid fa-plane-circle-check"></i> Add New Flight</h1>
            <form action="../controllers/FlightController.php?action=add" method="post">
                <div class="form-group">
                    <label for="airline"><i class="fa-solid fa-plane"></i> Airline</label>
                    <input type="text" id="airline" name="airline" placeholder="e.g., Emirates" required>
                </div>

                <div class="form-group">
                    <label for="flight_number"><i class="fa-solid fa-hashtag"></i> Flight Number</label>
                    <input type="text" id="flight_number" name="flight_number" placeholder="e.g., EK123" required>
                </div>

                <div class="form-group">
                    <label for="origin"><i class="fa-solid fa-plane-departure"></i> Origin</label>
                    <input type="text" id="origin" name="origin" placeholder="e.g., Dubai" required>
                </div>

                <div class="form-group">
                    <label for="destination"><i class="fa-solid fa-plane-arrival"></i> Destination</label>
                    <input type="text" id="destination" name="destination" placeholder="e.g., London" required>
                </div>

                <div class="form-group">
                    <label for="departure_time"><i class="fa-solid fa-clock"></i> Departure Time</label>
                    <input type="datetime-local" id="departure_time" name="departure_time" required>
                </div>

                <div class="form-group">
                    <label for="arrival_time"><i class="fa-solid fa-clock"></i> Arrival Time</label>
                    <input type="datetime-local" id="arrival_time" name="arrival_time" required>
                </div>

                <div class="form-group">
                    <label for="available_seats"><i class="fa-solid fa-chair"></i> Available Seats</label>
                    <input type="number" id="available_seats" name="available_seats" placeholder="e.g., 180" required min="1">
                </div>

                <div class="form-group">
                    <label for="price"><i class="fa-solid fa-dollar-sign"></i> Price ($)</label>
                    <input type="number" id="price" name="price" placeholder="e.g., 500" required min="0">
                </div>

                <button type="submit" class="btn-submit"><i class="fa-solid fa-plus"></i> Add Flight</button>
                <a href="manage_flights.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Back</a>
            </form>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

</body>

</html>