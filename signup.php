<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if form was submitted
    $uname = $_POST['uname'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['pass'];
    $confirm_password = $_POST['re_pass'];
    $address=$_POST['address'];

    // Debugging: Output form data
    //echo "Name: " . $name . "<br>";
    //echo "Email: " . $email . "<br>";
    //echo "Phone: " . $phone . "<br>";
    //echo "Password: " . $password . "<br>";
    //echo "Confirm Password: " . $confirm_password . "<br>";

    // Validate form data (check for empty fields)
    if (empty($uname)||empty($name) || empty($email) || empty($phone) || empty($password) || empty($confirm_password) ||  empty($address))  {
        echo "All fields are required.";
    } else {
        $sql = "INSERT INTO user (username,name, email, phone, password,address) VALUES ('$uname','$name', '$email', '$phone', '$password','$address')";

        if ($conn->query($sql) === TRUE) {
            echo "Record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
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
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
    <div class="form-group">
        <label for="uname"><i class="zmdi zmdi-account material-icons-name"></i></label>
        <input type="text" name="uname" id="uname" placeholder="Create a username" required />
    </div>
    <div class="form-group">
        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
        <input type="text" name="name" id="name" placeholder="Your Full Name" required />
    </div>
    <div class="form-group">
        <label for="email"><i class="zmdi zmdi-email"></i></label>
        <input type="email" name="email" id="email" placeholder="Your Email" required />
    </div>
    <div class="form-group">
        <label for="phone"><i class="zmdi zmdi-phone"></i></label>
        <input type="number" name="phone" id="phone" placeholder="Your Phone number" required />
    </div>
    <div class="form-group">
        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
        <input type="password" name="pass" id="pass" placeholder="Password" required />
    </div>
    <div class="form-group">
        <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
        <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" required />
</div>
<div class="form-group">
        <label for="email"><i class="zmdi zmdi-email"></i></label>
        <textarea name="address" id="address" placeholder="address" required ></textarea>
    </div>
    <div class="form-group">
        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required />
        <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
    </div>
    
    <div class="form-group form-button">
        <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
    </div>
    
</form>

                    </div>
                    <div class="signup-image">
                        <figure><img src="img/signup-image.jpg" alt="sing up image"></figure>
                        <a href="signin.php" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/login.js"></script>
</body>
</html>