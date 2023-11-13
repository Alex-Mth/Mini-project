<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['upload'])) {
        $image = $_FILES['image']['tmp_name'];

        if ($image) {
            $imageData = file_get_contents($image);
            $escapedImageData = $conn->real_escape_string($imageData);

            $bid = $_POST['bid'];  // Assuming bid is submitted through the form
            $building_type = $_POST['building_type'];  // Assuming building_type is submitted through the form

            $sql = "INSERT INTO building_images (image, bid, building_type) VALUES ('$escapedImageData', '$bid', '$building_type')";
            
            if ($conn->query($sql) === TRUE) {
                echo "Image uploaded and inserted into the database successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Please select an image file.";
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
    <title>Add Property</title>

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
                        <form method="POST" action="upload.php" class="register-form" id="register-form" enctype="multipart/form-data">
                            <!-- Remove other input fields except for the image -->
                            <div class="form-group">
                                <label for="image"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="file" name="image" id="image" accept="image/*" required />
                            </div>
                            <div class="form-group form-button">
                                <button type="submit" name="upload" class="form-submit">Register</button>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="img/signup-image.jpg" alt="sign up image"></figure>
                    </div>
                </div>
            </div>
        </section>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/login.js"></script>
</body>
</html>
