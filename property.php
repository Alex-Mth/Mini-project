<?php
include 'config.php';

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: signin.php');
    exit;
}

$username = $_SESSION['username'];

// Retrieve and display properties owned by the current user
$selectPropertiesQuery = "SELECT building.*, user.username AS username, booking.booking_id
                          FROM building
                          JOIN user ON building.username = user.username
                          LEFT JOIN booking ON building.bid = booking.bid
                          WHERE user.username = '$username'";
$result = $conn->query($selectPropertiesQuery);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display property details here
        echo "Property ID: " . $row['bid'] . "<br>";
        echo "Area: " . $row['areainsqft'] . "<br>";
        // Add more details as needed

        // Display booking details
        echo "Booking ID: " . ($row['booking_id'] ?? 'Not booked') . "<br>";
        echo "Status: " . (($row['booking_id'] != null) ? 'BOOKED' : 'NOT BOOKED') . "<br>";

        echo "<hr>";
    }
} else {
    echo "No properties found for the current user.";
}

$conn->close();
?>
