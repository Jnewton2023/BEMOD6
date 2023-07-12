<?php

// Function to establish a database connection
function establishConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $database = "testDatabase";

    $connection = mysqli_connect($servername, $username, $password, $database);

    if (!$connection) {
        exit("Database connection failed: " . mysqli_connect_error());
    }

    return $connection;
}

// Function to retrieve all bookings from the database
function getAllBookings() {
    $connection = establishConnection();

    $query = "SELECT * FROM bookings";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        exit("Database query failed");
    }

    $bookings = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $bookings[] = $row;
    }

    mysqli_free_result($result);
    mysqli_close($connection);

    return $bookings;
}

// Function to add a new booking to the database
function addBooking($package, $vehicle) {
    $connection = establishConnection();

    $package = mysqli_real_escape_string($connection, $package);
    $vehicle = mysqli_real_escape_string($connection, $vehicle);

    $query = "INSERT INTO bookings (packages, vehicles) VALUES ('$package', '$vehicle')";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        exit("Database query failed");
    }

    mysqli_close($connection);
}

// Function to update an existing booking in the database
function updateBooking($bookingId, $package, $vehicle) {
    $connection = establishConnection();

    $bookingId = mysqli_real_escape_string($connection, $bookingId);
    $package = mysqli_real_escape_string($connection, $package);
    $vehicle = mysqli_real_escape_string($connection, $vehicle);

    $query = "UPDATE bookings SET packages = '$package', vehicles = '$vehicle' WHERE id = '$bookingId'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        exit("Database query failed");
    }

    mysqli_close($connection);
}

// Function to delete a booking from the database
function deleteBooking($bookingId) {
    $connection = establishConnection();

    $bookingId = mysqli_real_escape_string($connection, $bookingId);

    $query = "DELETE FROM bookings WHERE id = '$bookingId'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        exit("Database query failed");
    }

    mysqli_close($connection);
}
?>
