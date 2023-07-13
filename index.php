<?php
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle the form submission from index.php
    if (isset($_POST['add'])) {
        // Add a new booking
        $selectedPackage = $_POST['package'];
        $selectedVehicle = $_POST['vehicle'];

        addBooking($selectedPackage, $selectedVehicle);

        // Redirect back to index.php with a success message
        header("Location: index.php?success=true");
        exit();
    } elseif (isset($_POST['edit'])) {
        // Edit an existing booking
        $bookingId = $_POST['booking_id'];
        $selectedPackage = $_POST['package'];
        $selectedVehicle = $_POST['vehicle'];

        updateBooking($bookingId, $selectedPackage, $selectedVehicle);

        // Redirect back to index.php with a success message
        header("Location: index.php?success=true");
        exit();
    } elseif (isset($_POST['delete'])) {
        // Delete an existing booking
        $bookingId = $_POST['booking_id'];

        deleteBooking($bookingId);

        // Redirect back to index.php with a success message
        header("Location: index.php?success=true");
        exit();
    }
}

// Retrieve all bookings from the database
$bookings = getAllBookings();
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

    <?php foreach ($bookings as $booking) : ?>
        <p>Booking ID: <?php echo $booking['id']; ?></p>
        <p>Package: <?php echo $booking['packages']; ?></p>
        <p>Vehicle: <?php echo $booking['vehicles']; ?></p>

        <form method="post" action="index.php">
            <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
            <label for="package">Package:</label>
            <input type="text" name="package" value="<?php echo $booking['packages']; ?>"><br>
            <label for="vehicle">Vehicle:</label>
            <input type="text" name="vehicle" value="<?php echo $booking['vehicles']; ?>"><br>
            <button type="submit" name="edit">Save</button>
            <button type="submit" name="delete">Delete</button>
        </form>

        <hr>
    <?php endforeach; ?>

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
