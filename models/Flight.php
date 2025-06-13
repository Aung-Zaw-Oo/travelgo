<?php
require_once '../config/database.php';

class Flight
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Get All Flights
     * @return array<int, array<string, mixed>>
     */

    public function getAllFlights()
    {
        $query = "SELECT * FROM flights";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addFlight($airline, $flight_number, $origin, $destination, $departure, $arrival, $seats, $price)
    {
        $query = "INSERT INTO flights (airline, flight_number, origin, destination, departure_time, arrival_time, available_seats, price)
                  VALUES (:airline, :flight_number, :origin, :destination, :departure_time, :arrival_time, :available_seats, :price)";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':airline', $airline);
        $stmt->bindParam(':flight_number', $flight_number);
        $stmt->bindParam(':origin', $origin);
        $stmt->bindParam(':destination', $destination);
        $stmt->bindParam(':departure_time', $departure);
        $stmt->bindParam(':arrival_time', $arrival);
        $stmt->bindParam(':available_seats', $seats);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

    public function deleteFlight($id)
    {
        $query = "DELETE FROM flights WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getFlightById($id)
    {
        $query = "SELECT * FROM flights WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateFlight($id, $airline, $flight_number, $origin, $destination, $departure, $arrival, $seats, $price)
    {
        $query = "UPDATE flights SET 
                    airline = :airline, 
                    flight_number = :flight_number,
                    origin = :origin, 
                    destination = :destination,
                    departure_time = :departure_time, 
                    arrival_time = :arrival_time, 
                    available_seats = :available_seats, 
                    price = :price
                  WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':airline', $airline);
        $stmt->bindParam(':flight_number', $flight_number);
        $stmt->bindParam(':origin', $origin);
        $stmt->bindParam(':destination', $destination);
        $stmt->bindParam(':departure_time', $departure);
        $stmt->bindParam(':arrival_time', $arrival);
        $stmt->bindParam(':available_seats', $seats);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function searchFlights($origin = '', $destination = '', $date = '')
    {
        $sql = "SELECT * FROM flights WHERE 1=1";
        $params = [];

        if (!empty($origin)) {
            $sql .= " AND origin LIKE ?";
            $params[] = '%' . $origin . '%';
        }

        if (!empty($destination)) {
            $sql .= " AND destination LIKE ?";
            $params[] = '%' . $destination . '%';
        }

        if (!empty($date)) {
            $sql .= " AND DATE(departure_time) = ?";
            $params[] = $date;
        }

        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }
}
