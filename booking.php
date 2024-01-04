<?php
session_start();
include 'config.php';
$propertyId=$_GET['bid'];
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

// Check if property ID is already in the session
//$propertyId = isset($_SESSION['bid']) ? $_SESSION['bid'] : null;

// If property ID is not set, retrieve it based on some condition (e.g., username)
//if (!$propertyId && isset($_SESSION['username'])) {
   // $username = $_SESSION['username'];

    // Query to get property ID based on the username (you might need to adjust this query)
  //  $query = "SELECT bid FROM building WHERE username = '$username'";
   // $result = $conn->query($query);

  //  if ($result->num_rows > 0) {
 //       $row = $result->fetch_assoc();
    
 //   }
//}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if form was submitted
    $end_date = $_POST['end_date'];

    // Validate form data (check for empty fields)
    if (empty($end_date)) {
        echo "All fields are required.";
    } else {
        if ($propertyId) {
            // Insert booking details into the database
            $username = $_SESSION['username'];
            $sql= "INSERT INTO `order` ( bid,username) VALUES ('$propertyId','$username')";
          
            if ($conn->query($sql) !== TRUE) {
                $_SESSION['success_message'] = "Booking details added successfully.";

                // Redirect to the same page after successful form submission
                header('Location:index.php');
                exit;
            } 
            $bookingSql = "UPDATE booking SET end_date='$end_date' WHERE bid='$propertyId' ";

            echo "SQL Query: $bookingSql<br>";

            if ($conn->query($bookingSql) !== TRUE) {
                echo "Error: " . $bookingSql . "<br>" . $conn->error;
            } else {
                // Set success message in session
                $_SESSION['success_message'] = "Booking details added successfully.";

                // Redirect to the same page after successful form submission
                header('Location:index.php');
                exit;
            }
        } else {
            echo "Error: Invalid property ID.";
        }
    }
}

$conn->close();



if (isset($_SESSION['success_message'])) {
    echo "<div id='myModal' class='modal'>
            <div class='modal-content'>
                <div style='text-align: center;'>
                    <i class='fas fa-check-circle' style='font-size: 48px; color: #4CAF50;'></i>
                </div>
                <p style='text-align: center;'>" . $_SESSION['success_message'] . "</p>
                <button onclick='closeModal()' style='background-color: #4CAF50; color: white;'>OK</button>
            </div>
          </div>

          <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Show the modal box
                var modal = document.getElementById('myModal');
                modal.style.display = 'block';
                // Remove the message from session
                " . "deleteMessage(); 
            });

            function deleteMessage() {
                // Function to remove the message from session
                fetch('delete_message.php', {
                    method: 'GET',
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data);
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            }

            function closeModal() {
                // Function to close the modal box
                var modal = document.getElementById('myModal');
                modal.style.display = 'none';
            }
          </script>";
  
    // Remove the success message from the session to avoid displaying it on page refresh
    unset($_SESSION['success_message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking Table</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="main">

<!-- Sign in  Form -->
<section class="sign-in">
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="img/780.png" ></figure>   
            </div>

            <div class="signin-form">
                <h2 class="form-title">Booking Details</h2>
                <form method="POST" class="register-form" id="login-form">
                    <div class="form-group">
                        <label for="end_date"><i class="zmdi zmdi-lock"></i></label>
                        <input type="date" name="end_date" id="end_date" placeholder="Expire date of booking"/>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="booking_now" id="booking_now" class="form-submit" value="Book Now"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/login.js"></script>
</body>
</html>
