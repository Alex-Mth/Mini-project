<?php
include 'config.php';

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: signin.php');
    exit;
}

$username = $_SESSION['username'];

// Retrieve and display properties owned by the current user
$selectPropertiesQuery = "SELECT building.*, user.username AS owner_username FROM building ,user
                          JOIN user ON building.owner_username = user.username
                          WHERE user.username = '$username'";
$result = $conn->query($selectPropertiesQuery);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display property details here
        echo "Property ID: " . $row['bid'] . "<br>";
        echo "Area: " . $row['areainsqft'] . "<br>";
        // Add more details as needed
        echo "<hr>";
    }
} else {
    echo "No properties found for the current user.";
}

$conn->close();
?>
