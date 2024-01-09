<?php
session_start();
include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["bid"])) {
    
    $productId = $_POST["bid"];
    $username = $_SESSION['username'];
    $removeCartItemQuery = "DELETE FROM order WHERE bid = ? AND username = ?";
    $stmt = $conn->prepare($removeCartItemQuery);

    if ($stmt) {
        $stmt->bind_param("is", $productId, $username);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Item removed successfully!";
        } else {
            echo "Failed to remove the item from the cart.";
        }

        $stmt->close();
    } else {
        echo "Error: Unable to prepare the SQL statement.";
    }

    $conn->close();
} else {
    echo "Invalid request!";
}
?>