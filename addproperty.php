<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if form was submitted
    $area = $_POST['areainsqft'];
    $desc = $_POST['description'];
    $bedroom = $_POST['bedrooms'];
    $bathroom = $_POST['bathrooms'];
    $floor = $_POST['floor'];
    $roof = $_POST['roof'];
    $age=$_POST['age'];
    $condition=$_POST['condition'];
    $btype=$_POST['building_type'];
    

    // Debugging: Output form data
    //echo "Name: " . $name . "<br>";
    //echo "Email: " . $email . "<br>";
    //echo "Phone: " . $phone . "<br>";
    //echo "Password: " . $password . "<br>";
    //echo "Confirm Password: " . $confirm_password . "<br>";

    // Validate form data (check for empty fields)
    if (empty($area)||empty($desc) || empty($bedroom) || empty($bathroom) || empty($floor) || empty($roof) ||  empty($age)||  empty($condition)||  empty($btype))  {
        echo "All fields are required.";
    } else {
        $sql = "INSERT INTO building (areainsqft,description,bedrooms,bathrooms,floor,roof,age,condition,building_type) VALUES ('$area','$desc', '$bedroom', '$bathroom', '$floor','$roof','$age,'$condition','$btype')";

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
                        <h2 class="form-title">Add Property</h2>
                        <form method="POST" class="register-form" id="register-form">
    <div class="form-group">
        <label for="areainsqft"><i class="zmdi zmdi-account material-icons-name"></i></label>
        <input type="text" name="areainsqft" id="areainsqft" placeholder=" AREA IN SQUARE FEAT" required />
    </div>
    <div class="form-group">
        <label for="bathrooms"><i class="zmdi zmdi-account material-icons-name"></i></label>
        <input type="number" name="bathrooms" id="bathrooms" placeholder="number of bathrooms" required />
    </div>
    <div class="form-group">
        <label for="bedrooms"><i class="zmdi zmdi-email"></i></label>
        <input type="number" name="bedrooms" id="bedrooms" placeholder="number of bedrooms" required />
    </div>
    <div class="form-group">
        <label for="floor"><i class="zmdi zmdi-phone"></i></label>
        <input type="number" name="floor" id="floor" placeholder="number of floor" required />
    </div>
    <div class="form-group">
        <label for="roof"><i class="zmdi zmdi-lock"></i></label>
        <input type="text" name="roof" id="roof" placeholder="roofing type" required />
    </div>
    <div class="form-group">
        <label for="age"><i class="zmdi zmdi-lock-outline"></i></label>
        <input type="number" name="age" id="age" placeholder="age" required />
</div>
<div class="form-group">
        <label for="condition"><i class="zmdi zmdi-lock-outline"></i></label>
        <input type="varchar" name="condition" id="condition" placeholder="condition of your building" required />
</div>



<div class="form-group">
<div class="form-check">
<div style="display:flex; align-items: center;flex-direction: row;">
    <p style="margin:0px;">appartment</p>
    <input style="width:15px;" class="form-check-input" type="radio" name="building_type" id="building_type" value="apartment">
</div>
<div style="display:flex; align-items: center;flex-direction: row;">
    <p style="margin:0px;">villa</p>
    <input style="width:15px;" class="form-check-input" type="radio" name="building_type" id="building_type" value="villa">   
</div>

<div style="display:flex; align-items: center;flex-direction: row;">
    <p style="margin:0px;">home</p>
    <input style="width:15px;" class="form-check-input" type="radio" name="building_type" id="building_type" value="home">  
</div>
<div style="display:flex; align-items: center;flex-direction: row;">
    <p style="margin:0px;">shop</p>
    <input style="width:15px;"  class="form-check-input" type="radio" name="building_type" id="building_type" value="shop">  
</div>
</div>
</div>
<div class="form-group">
        <label for="description"><i class="zmdi zmdi-email"></i></label>
        <textarea name="description" id="description" placeholder="description" required ></textarea>
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