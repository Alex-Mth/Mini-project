

<?php
// Include your database connection and necessary configurations
include 'config.php';

error_log("removeitem.php called");
$productId = $_POST["product_id"];
error_log("Product ID: " . $productId);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["bid"])) {
    // Get the product ID from the POST data
    $productId = $_POST["bid"];

    // Perform the necessary database update to remove the item from the order
    // You might want to set the order status to "removed" or similar

    // Example: Update the 'order' table
    $removeItemQuery = "UPDATE `order` SET status = 'removed' WHERE bid = ?";
    $stmtRemoveItem = $conn->prepare($removeItemQuery);
    $stmtRemoveItem->bind_param("i", $productId);
    $stmtRemoveItem->execute();
    $stmtRemoveItem->close();

    // Close the database connection
    $conn->close();

    // Send a response to indicate success
    echo "Item removed successfully";
} else {
    // Send a response to indicate failure
    echo "Invalid request";
}
error_log("Received request to remove item. Product ID: " . $_POST["product_id"]);

?>


