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
    <title>Manage Flights</title>
    <link rel="stylesheet" href="../assets/css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
            color: var(--decent-color);
            margin-bottom: 1rem;
        }

        .btn-add {
            display: inline-block;
            background: var(--decent-color);
            color: var(--text-color);
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 1rem;
            transition: background 0.3s ease;
        }

        .btn-add:hover {
            background: var(--accent-color);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            padding: 0.75rem;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background: var(--primary-color);
            color: var(--text-color);
        }

        table td {
            background: var(--text-color);
            padding: 0.75rem 0;
            text-align: center;
            border: 1px solid var(--text-color);
        }

        .btn-edit,
        .btn-delete {
            text-decoration: none;
            color: var(--text-color);
            padding: 0.4rem 0.6rem;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .btn-edit {
            background: #4CAF50;
            margin-right: 0.4rem;
        }

        .btn-edit:hover {
            background: #43a047;
        }

        .btn-delete {
            background: #E74C3C;
        }

        .btn-delete:hover {
            background: #c0392b;
        }


        @media screen and (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead tr {
                display: none;
            }

            tr {
                margin-bottom: 1rem;
                border-bottom: 2px solid #ddd;
            }

            td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 1rem;
                font-weight: bold;
                text-align: left;
                color: var(--primary-color);
            }

            .btn-edit,
            .btn-delete {
                display: inline-block;
                margin-top: 0.5rem;
                width: 25%;
            }
        }
    </style>
</head>

<body>

    <?php include '../includes/header.php'; ?>

    <div class="container">
        <h1><i class="fa-solid fa-plane-departure"></i> Manage Flights</h1>
        <a href="add_flights.php" class="btn-add"><i class="fa-solid fa-plus"></i> Add New Flight</a>

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
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($flight['airline']) ?></td>
                            <td><?= htmlspecialchars($flight['flight_number']) ?></td>
                            <td><?= htmlspecialchars($flight['origin']) ?></td>
                            <td><?= htmlspecialchars($flight['destination']) ?></td>
                            <td><?= htmlspecialchars($flight['departure_time']) ?></td>
                            <td><?= htmlspecialchars($flight['arrival_time']) ?></td>
                            <td><?= htmlspecialchars($flight['available_seats']) ?></td>
                            <td><?= htmlspecialchars($flight['price']) ?></td>
                            <td class="actions">
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

    <?php include '../includes/footer.php'; ?>

</body>

</html>