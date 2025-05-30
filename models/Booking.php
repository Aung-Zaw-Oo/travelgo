<?php
require_once '../config/database.php';

class Booking extends Database
{
    public function createBooking($user_id, $flight_id, $name, $email, $phone, $passport, $payment_method, $ticket_number)
    {
        $sql = "INSERT INTO bookings (user_id, flight_id, name, email, phone, passport, payment_method, ticket_number) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id, $flight_id, $name, $email, $phone, $passport, $payment_method, $ticket_number]);
        return $this->conn->lastInsertId();
    }


    public function getUserBookings($user_id)
    {
        $sql = "SELECT b.*, f.airline, f.origin, f.destination, f.departure_time, f.arrival_time, f.price
                FROM bookings b
                JOIN flights f ON b.flight_id = f.id
                WHERE b.user_id = ?
                ORDER BY b.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public function getBookingById($booking_id)
    {
        $sql = "SELECT b.*, f.airline, f.origin, f.destination, f.departure_time, f.arrival_time, f.price
                FROM bookings b
                JOIN flights f ON b.flight_id = f.id
                WHERE b.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$booking_id]);
        return $stmt->fetch();
    }

    // In Booking.php
    public function getBookingDetails($booking_id)
    {
        $sql = "SELECT b.*, f.flight_number, f.airline, f.origin, f.destination, f.departure_time, f.arrival_time 
            FROM bookings b 
            JOIN flights f ON b.flight_id = f.id 
            WHERE b.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$booking_id]);
        return $stmt->fetch();
    }
}
