<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

require_once '../models/Ticket.php';
$ticketModel = new Ticket();
$tickets = $ticketModel->getAllTickets(); // Adjust method name accordingly
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TravelGO | Manage Tickets</title>
    <link rel="stylesheet" href="../includes/reset.css" />
    <link rel="stylesheet" href="../includes/assets/css/manage_tickets.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>

    <?php include '../includes/header.php'; ?>

    <main>
        <div class="container">
            <h1><i class="fa-solid fa-ticket"></i> Manage Tickets</h1>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Passenger Name</th>
                        <th>Email</th>
                        <th>Flight</th>
                        <th>Booking Date</th>
                        <th>Booking Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($tickets)): ?>
                        <?php foreach ($tickets as $index => $ticket): ?>
                            <tr>
                                <td data-label="#"> <?= $index + 1 ?> </td>
                                <td data-label="Passenger Name"><?= htmlspecialchars($ticket['name']) ?></td>
                                <td data-label="Email"><?= htmlspecialchars($ticket['email']) ?></td>
                                <td data-label="Flight"><?= htmlspecialchars($ticket['flight_name']) ?></td>
                                <td data-label="Booking Date"><?= htmlspecialchars($ticket['created_at']) ?></td>
                                <td data-label="Booking Date"><?= htmlspecialchars($ticket['status']) ?></td>
                                <td data-label="Actions" class="actions">
                                    <a href="ticket_detail.php?id=<?= $ticket['id'] ?>" class="btn-action" title="Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="ticket_action.php?action=approve&id=<?= $ticket['id'] ?>" class="btn-action approve" title="Approve">
                                        <i class="fa-solid fa-check"></i>
                                    </a>
                                    <a href="ticket_action.php?action=decline&id=<?= $ticket['id'] ?>" class="btn-action decline" title="Decline">
                                        <i class="fa-solid fa-xmark"></i>
                                    </a>
                                    <a href="ticket_action.php?action=delete&id=<?= $ticket['id'] ?>" class="btn-action delete" title="Delete" onclick="return confirm('Are you sure you want to delete this ticket?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">No tickets found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

</body>

</html>