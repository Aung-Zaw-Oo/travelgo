<?php
require_once '../config/database.php';

class Ticket
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function getAllTickets()
    {
        $stmt = $this->pdo->prepare(
            "SELECT 
                bookings.id, 
                bookings.name, 
                bookings.email, 
                bookings.phone, 
                bookings.passport, 
                bookings.payment_method,
                bookings.ticket_number,
                bookings.created_at,
                bookings.status,
                CONCAT(flights.origin, ' → ', flights.destination) AS flight_name
            FROM bookings
            JOIN flights ON bookings.flight_id = flights.id
            ORDER BY bookings.created_at DESC"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: null;
    }


    public function getTicketById($id)
    {
        $sql = "SELECT t.*, f.flight_number, f.origin, f.destination, f.departure_time, f.arrival_time, f.price
                FROM bookings t
                JOIN flights f ON t.flight_id = f.id
                WHERE t.id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }


    public function approveTicket($id)
    {
        $sql = "UPDATE bookings SET status = 'approved' WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }


    public function declineTicket($id)
    {
        $sql = "UPDATE bookings SET status = 'declined' WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }


    public function deleteTicket($id)
    {
        $sql = "DELETE FROM bookings WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function addTicket($flight_id, $name, $email, $phone, $passport, $payment_method)
    {
        $sql = "INSERT INTO bookings (flight_id, name, email, phone, passport, payment_method, created_at, status)
                VALUES (:flight_id, :name, :email, :phone, :passport, :payment_method, NOW(), 'pending')";

        $stmt = $this->pdo->prepare($sql);


        $stmt->bindParam(':flight_id', $flight_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':passport', $passport, PDO::PARAM_STR);
        $stmt->bindParam(':payment_method', $payment_method, PDO::PARAM_STR);

        return $stmt->execute();
    }
}
