<?php

require_once '../models/Flight.php';

$flight = new Flight();

if (isset($_GET['action']) && $_GET['action'] == 'add') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $airline = $_POST['airline'];
        $flightNumber = $_POST['flight_number'];
        $origin = $_POST['origin'];
        $destination = $_POST['destination'];
        $departure = $_POST['departure_time'];
        $arrival = $_POST['arrival_time'];
        $seats = $_POST['available_seats'];
        $price = $_POST['price'];

        $flight->addFlight($airline, $flightNumber, $origin, $destination, $departure, $arrival, $seats, $price);

        header("Location: ../views/manage_flights.php");
        exit();
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $airline = $_POST['airline'];
        $flightNumber = $_POST['flight_number'];
        $origin = $_POST['origin'];
        $destination = $_POST['destination'];
        $departure = $_POST['departure_time'];
        $arrival = $_POST['arrival_time'];
        $seats = $_POST['available_seats'];
        $price = $_POST['price'];

        $flight->updateFlight($id, $airline, $flightNumber, $origin, $destination, $departure, $arrival, $seats, $price);

        header("Location: ../views/manage_flights.php");
        exit();
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $flight->deleteFlight($_GET['id']);
    header("Location: ../views/manage_flights.php");
    exit();
}
