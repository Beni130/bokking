<?php
// Include database connection file
$servername = "localhost";
$username = "root";  // default username for XAMPP
$password = "";      // default password for XAMPP
$dbname = "booking_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $booking_date = $_POST['booking_date'];
    $phone = $_POST['phone'];
    $plan = $_POST['plan'];
    $guests = $_POST['guests'];
    $special_requests = $_POST['special_requests'];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO bookings (full_name, email, booking_date, phone, plan, guests, special_requests) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssis", $full_name, $email, $booking_date, $phone, $plan, $guests, $special_requests);

    if ($stmt->execute()) {
        echo "Booking successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
