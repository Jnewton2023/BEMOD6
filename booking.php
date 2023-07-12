<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission from index.html
    $selectedPackage = $_POST['package'];
    $selectedVehicle = $_POST['vehicle'];

    // Save the booking details to the database
    $databaseConnection = mysqli_connect("localhost", "root", "root", "testDatabase");
    if (mysqli_connect_errno()) {
        exit("Database connection failed");
    }

    $selectedPackage = mysqli_real_escape_string($databaseConnection, $selectedPackage);
    $selectedVehicle = mysqli_real_escape_string($databaseConnection, $selectedVehicle);

    $query = "INSERT INTO bookings (packages, vehicles) VALUES ('$selectedPackage', '$selectedVehicle')";
    $result = mysqli_query($databaseConnection, $query);

    if (!$result) {
        exit("Database query failed");
    }

    mysqli_close($databaseConnection);

    // Redirect back to index.html with a success message
    header("Location: index.html?success=true");
    exit();
} else {
    // Redirect back to index.html if accessed directly without form submission
    header("Location: index.html");
    exit();
}
?>
