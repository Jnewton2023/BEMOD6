<?php
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission from index.php
    $selectedPackage = $_POST['package'];
    $selectedVehicle = $_POST['vehicle'];

    addBooking($selectedPackage, $selectedVehicle);

    // Redirect back to index.php with a success message
    header("Location: index.php?success=true");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JN Auto Detailing</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header> 
        <h1><u>Welcome to JN's Auto Detailing</u></h1> 
    </header>
    <h2><u>Services</u></h2>
    <img src="https://detailtime.net/wp-content/uploads/2022/01/what-is-auto-detailing.webp" alt="Auto Detailing">
    <p>Come schedule an appointment and drop off your vehicle to take a break from your jam-packed personal and professional days!</p>
    <h2><u>Bookings</u></h2>

    <form method="post" action="index.php">
        <label for="package">Select a Package:</label>
        <select name="package" id="package">
            <option value="Gold package">Gold package</option>
            <option value="Diamond package">Diamond package</option>
            <option value="Platinum package">Platinum package</option>
        </select>
        <br>
        <label for="vehicle">Select a Vehicle:</label>
        <select name="vehicle" id="vehicle">
            <option value="Honda Accord">Honda Accord</option>
            <option value="Toyota Camry">Toyota Camry</option>
            <option value="Nissan Altima">Nissan Altima</option>
        </select>
        <br>
        <button type="submit" name="add">Add Booking</button>
    </form>
</body>
</html>
