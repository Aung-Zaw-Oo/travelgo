<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

require_once '../config/database.php';

$db = new Database();
$conn = $db->getConnection();

$user_id = $_SESSION['user']['id'];

if (isset($_POST['cancel_booking_id'])) {
    $cancel_id = (int)$_POST['cancel_booking_id'];
    $cancelStmt = $conn->prepare("UPDATE bookings SET status = 'cancelled' WHERE id = :id AND user_id = :user_id AND status != 'cancelled'");
    $cancelStmt->execute([':id' => $cancel_id, ':user_id' => $user_id]);
    $cancel_message = $cancelStmt->rowCount() ? "Booking #$cancel_id cancelled successfully." : "Cancellation failed or already cancelled.";
}

$statusFilter = $_GET['status'] ?? '';
$flightFilter = $_GET['flight'] ?? '';

$sql = "SELECT 
            b.id, b.flight_id, b.name, b.email, b.phone, b.passport, b.payment_method, 
            b.ticket_number, b.created_at, b.status, b.seat,
            f.flight_number, f.origin, f.destination, f.departure_time, f.arrival_time
        FROM bookings b
        LEFT JOIN flights f ON b.flight_id = f.id
        WHERE b.user_id = :user_id";

$params = [':user_id' => $user_id];

if ($statusFilter && in_array($statusFilter, ['pending', 'confirmed', 'cancelled'])) {
    $sql .= " AND b.status = :status";
    $params[':status'] = $statusFilter;
}

if ($flightFilter) {
    $sql .= " AND f.flight_number LIKE :flight";
    $params[':flight'] = "%$flightFilter%";
}

$sql .= " ORDER BY b.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->execute($params);
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_booking_id'])) {
    $cancelId = $_POST['cancel_booking_id'];

    $stmt = $conn->prepare("UPDATE bookings SET status = 'cancelled' WHERE id = ?");
    $stmt->execute([$cancelId]);

    $cancel_message = "Booking #$cancelId has been cancelled.";
}
?>

<!DOCTYPE html>
<html land="en">

<head>
    <meta charset="UTF-8" />
    <title>My Bookings</title>
    <link rel="stylesheet" href="../includes/reset.css" />
    <link rel="stylesheet" href="../includes/assets/css/my_booking.css">
</head>

<body>

    <?php include "../includes/header.php" ?>

    <main>
        <div class="container">
            <h1>My Bookings</h1>

            <?php if (isset($cancel_message)): ?>
                <p><strong><?= htmlspecialchars($cancel_message) ?></strong></p>
            <?php endif; ?>

            <!-- Filter Form -->
            <form method="GET" class="filter-form">
                <label>
                    Status:
                    <select name="status">
                        <option value="">-- All --</option>
                        <option value="pending" <?= $statusFilter === 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="confirmed" <?= $statusFilter === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                        <option value="cancelled" <?= $statusFilter === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                    </select>
                </label>
                <label>
                    Flight Number:
                    <input type="text" name="flight" value="<?= htmlspecialchars($flightFilter) ?>" placeholder="Search flight number" />
                </label>
                <button type="submit">Filter</button>
            </form>

            <?php if (!empty($bookings)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Flight Number</th>
                            <th>From</th>
                            <th>To</th>
                            <th>Departure Time</th>
                            <th>Arrival Time</th>
                            <th>Seat</th>
                            <th>Ticket Number</th>
                            <th>Payment Method</th>
                            <th>Booking Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $serial = 1; ?>
                        <?php foreach ($bookings as $b): ?>
                            <tr>
                                <td data-label="#"><?= $serial++ ?></td>
                                <td data-label="Flight Number"><?= htmlspecialchars($b['flight_number'] ?? 'N/A') ?></td>
                                <td data-label="Origin"><?= htmlspecialchars($b['origin'] ?? 'N/A') ?></td>
                                <td data-label="Destination"><?= htmlspecialchars($b['destination'] ?? 'N/A') ?></td>
                                <td data-label="Departure"><?= htmlspecialchars($b['departure_time'] ?? 'N/A') ?></td>
                                <td data-label="Arrival"><?= htmlspecialchars($b['arrival_time'] ?? 'N/A') ?></td>
                                <td data-label="Seat"><?= htmlspecialchars($b['seat']) ?></td>
                                <td data-label="Ticket Number"><?= htmlspecialchars($b['ticket_number']) ?></td>
                                <td data-label="Payment Method"><?= htmlspecialchars($b['payment_method']) ?></td>
                                <td data-label="Booking Date"><?= htmlspecialchars(date('Y-m-d', strtotime($b['created_at']))) ?></td>
                                <td data-label="Status" class="status-<?= strtolower($b['status']) ?>">
                                    <?= htmlspecialchars(ucfirst($b['status'])) ?>
                                </td>
                                <td>
                                    <button class="view-details"
                                        onclick='showDetails(<?= json_encode($b) ?>)'>View</button>
                                    <?php if ($b['status'] !== 'cancelled'): ?>
                                        <button class="cancel-btn" onclick="confirmCancel(<?= $b['id'] ?>)">Cancel</button>
                                    <?php else: ?>
                                        <button class="cancel-btn" disabled>Cancelled</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>You have no bookings matching the criteria.</p>
            <?php endif; ?>

            <!-- Hidden form for cancellation -->
            <form id="cancel_form" method="POST" style="display:none;">
                <input type="hidden" name="cancel_booking_id" id="cancel_booking_id" value="" />
            </form>

            <!-- Modal for details -->
            <div id="details_modal" class="modal" onclick="closeModal()">
                <div class="modal-content" onclick="event.stopPropagation()">
                    <span class="close-btn" onclick="closeModal()">×</span>
                    <h2>Booking Details</h2>
                    <p><strong>Booking ID:</strong> <span id="modal_booking_id"></span></p>
                    <p><strong>Flight Number:</strong> <span id="modal_flight_number"></span></p>
                    <p><strong>Origin:</strong> <span id="modal_origin"></span></p>
                    <p><strong>Destination:</strong> <span id="modal_destination"></span></p>
                    <p><strong>Departure Time:</strong> <span id="modal_departure_time"></span></p>
                    <p><strong>Arrival Time:</strong> <span id="modal_arrival_time"></span></p>
                    <p><strong>Seat:</strong> <span id="modal_seat"></span></p>
                    <p><strong>Ticket Number:</strong> <span id="modal_ticket_number"></span></p>
                    <p><strong>Payment Method:</strong> <span id="modal_payment_method"></span></p>
                    <p><strong>Booking Date:</strong> <span id="modal_created_at"></span></p>
                    <p><strong>Status:</strong> <span id="modal_status"></span></p>
                    <hr>
                    <h3>Passenger Info</h3>
                    <p><strong>Name:</strong> <span id="modal_name"></span></p>
                    <p><strong>Email:</strong> <span id="modal_email"></span></p>
                    <p><strong>Phone:</strong> <span id="modal_phone"></span></p>
                    <p><strong>Passport:</strong> <span id="modal_passport"></span></p>
                </div>
            </div>
        </div>
    </main>

    <?php include "../includes/footer.php" ?>

</body>

<script>
    function showDetails(booking) {
        // Fill modal fields with booking data
        document.getElementById('modal_booking_id').innerText = booking.id;
        document.getElementById('modal_flight_number').innerText = booking.flight_number;
        document.getElementById('modal_origin').innerText = booking.origin;
        document.getElementById('modal_destination').innerText = booking.destination;
        document.getElementById('modal_departure_time').innerText = booking.departure_time;
        document.getElementById('modal_arrival_time').innerText = booking.arrival_time;
        document.getElementById('modal_seat').innerText = booking.seat;
        document.getElementById('modal_ticket_number').innerText = booking.ticket_number;
        document.getElementById('modal_payment_method').innerText = booking.payment_method;
        document.getElementById('modal_created_at').innerText = booking.created_at;
        document.getElementById('modal_status').innerText = booking.status;

        document.getElementById('modal_name').innerText = booking.name;
        document.getElementById('modal_email').innerText = booking.email;
        document.getElementById('modal_phone').innerText = booking.phone;
        document.getElementById('modal_passport').innerText = booking.passport;

        // Show the modal
        document.getElementById('details_modal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('details_modal').style.display = 'none';
    }
</script>

<script>
    function confirmCancel(bookingId) {
        if (confirm('Are you sure you want to cancel this booking?')) {
            document.getElementById('cancel_booking_id').value = bookingId;
            document.getElementById('cancel_form').submit();
        }
    }
</script>



</html>