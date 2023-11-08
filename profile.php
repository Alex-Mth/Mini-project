<?php
session_start();
include('config.php');

if (!isset($_SESSION['userid'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['userid'];

// Create a prepared statement to protect against SQL injection
$sql = "SELECT * FROM users WHERE id = $user_id";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the parameter and execute the statement
    $stmt->bind_param("i", $user_id); // Assuming 'id' is an integer
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Use $user as needed
    } else {
        // Handle the case where the user was not found
    }

    // Close the statement and result set
    $stmt->close();
    $result->close();
} else {
    // Handle the case where the prepared statement couldn't be created
}

// Close the database connection when you're done with it
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>ProDeal - User Profile</title>
    <!-- Add CSS and JavaScript references here -->
</head>
<body>
    <h1>User Profile</h1>
    <p>Welcome, <?php echo $full_name; ?> (Username: <?php echo $username; ?>)</p>
    <p>Email: <?php echo $email; ?></p>
    <!-- Add more user information as needed -->

    <!-- Add edit and logout buttons or links -->
</body>
</html>