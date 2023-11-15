<?php
session_start();
include 'config.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if form was submitted
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to check if the user exists with the given email and password
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, get their id and redirect accordingly
        $row = $result->fetch_assoc();
        $userId = $row['userid'];

        if ($userId == 0) {
            // Admin
            header("Location: admin.php");
            exit();
        } elseif ($userId == 1) {
            // Regular user
            session_start(); // Start the session
            $_SESSION['username'] = $row['username']; // Store the username in the session
            header("Location: index.php");
            exit();
        } elseif ($userId == 2) {
            // Seller
            session_start(); // Start the session
            $_SESSION['username'] = $row['username']; // Store the username in the session
            header("Location: seller.php");
            exit();
        } else {
            // Invalid user id
            echo "Invalid user ID.";
        }
    } else {
        // User not found, display an error message
        echo "User does not exist.";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

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
                <a href="signup.php" class="signup-image-link">Create an account</a>
            </div>

            <div class="signin-form">
                <h2 class="form-title">Sign In</h2>
                <form method="POST" class="register-form" id="login-form">
                    <div class="form-group">
                        <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="username" id="username" placeholder="Your username"/>
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="password" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                        <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
            
                    </div>
                </form>
                <div class="social-login">
                    <span class="social-label">Or login with</span>
                    <ul class="socials">
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

</div>
<!-- JS -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/login.js"></script>
</body>
</html>