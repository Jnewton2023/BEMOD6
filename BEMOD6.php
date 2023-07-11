<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JN Auto Detailing</title>
</head>
<body>
    <header> 
        <h1><u>Welcome to JN's Auto Detailing</u></h1> 
    </header>
    <h2><u>Services</u></h2>
    <p>Come schedule an appointment and drop off your vehicle to take a break from your jam-packed personal and professional days!</p>
    <h2><u>Bookings</u></h2>

    <?php
    // Include the database connection file
    include 'testDatabase';

    // Handle form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add'])) {
            // Handle adding a new booking
            $selectedPackage = $_POST['package'];
            $selectedVehicle = $_POST['vehicle'];
    ?>
     <!-- Add the image -->
     <img src="https://detailtime.net/wp-content/uploads/2022/01/what-is-auto-detailing.webp" alt="Auto Detailing">

     <?php
              // Save the booking details to the database
            $query = "INSERT INTO bookings (packages, vehicles) VALUES ('$selectedPackage', '$selectedVehicle')";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                exit("Database query failed");
            }
        } elseif (isset($_POST['edit'])) {
            // Handle editing an existing booking
            $bookingId = $_POST['booking_id'];
            $selectedPackage = $_POST['package'];
            $selectedVehicle = $_POST['vehicle'];

            // Update the booking details in the database
            $query = "UPDATE bookings SET packages = '$selectedPackage', vehicles = '$selectedVehicle' WHERE id = '$bookingId'";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                exit("Database query failed");
            }
        } elseif (isset($_POST['delete'])) {
            // Handle deleting an existing booking
            $bookingId = $_POST['booking_id'];

            // Delete the booking from the database
            $query = "DELETE FROM bookings WHERE id = '$bookingId'";
            $result = mysqli_query($connection, $query);

            if (!$result) {
                exit("Database query failed");
            }
        }
    }

    // Retrieve booking details from the database
    $query = "SELECT * FROM bookings";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        exit("Database query failed");
    }

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<p>Booking ID: " . $row['id'] . "</p>";
        echo "<p>Package: " . $row['packages'] . "</p>";
        echo "<p>Vehicle: " . $row['vehicles'] . "</p>";

        // Display the edit form for each booking
        echo "<form method='post'>";
        echo "<input type='hidden' name='booking_id' value='" . $row['id'] . "'>";
        echo "<label for='package'>Package:</label>";
        echo "<input type='text' name='package' value='" . $row['packages'] . "'><br>";
        echo "<label for='vehicle'>Vehicle:</label>";
        echo "<input type='text' name='vehicle' value='" . $row['vehicles'] . "'><br>";
        echo "<button type='submit' name='edit'>Save</button>";
        echo "<button type='submit' name='delete'>Delete</button>";
        echo "</form>";

        echo "<hr>";
    }

    mysqli_free_result($result);
    mysqli_close($connection);
    ?>

    <form method="post">
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
