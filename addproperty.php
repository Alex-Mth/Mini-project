<?php
session_start(); // Start the session
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if form was submitted
    $area = $_POST['areainsqft'];
    $desc = $_POST['description'];
    $bedroom = $_POST['bedrooms'];
    $bathroom = $_POST['bathrooms'];
    $floor = $_POST['floor'];
    $roof = $_POST['roof'];
    $age = $_POST['age'];
    $price=$_POST['price'];
    $condition = $_POST['condition'];
    $btype = $_POST['building_type'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];

    // Validate form data (check for empty fields)
    if (empty($area) || empty($desc) || empty($bedroom) || empty($bathroom) || empty($floor) || empty($roof) || empty($age) || empty($price) || empty($condition) || empty($btype) || empty($address) || empty($city) || empty($state)) {
        echo "All fields are required.";
    } else {
        // Insert property details into the database
        $sql = "INSERT INTO building (areainsqft, description, bedrooms, bathrooms, floor, roof, age, price, `condition`, building_type,address,city,state) VALUES ('$area', '$desc', '$bedroom', '$bathroom', '$floor', '$roof', '$age', '$price', '$condition', '$btype' ,'$address' , '$city' , '$state')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        } else {
            // Get the last inserted property ID
            $propertyId = $conn->insert_id;

            // Insert image data into the database with the associated property ID
            if (!empty($_FILES['images']['name'][0])) {
                foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                    $file_name = $_FILES['images']['name'][$key];
                    $targetFilePath = $file_name;
                    move_uploaded_file($tmp_name, $targetFilePath);

                    // Insert image name into the database
                    $imageSql = "INSERT INTO building_images (bid, image) VALUES ('$propertyId', '$targetFilePath')";
                    if ($conn->query($imageSql) !== TRUE) {
                        echo "Error: " . $imageSql . "<br>" . $conn->error;
                    }
                }
            }

            // Insert additional images into the new columns
            if (!empty($_FILES['images1']['name'][0])) {
                $file_name = $_FILES['images1']['name'][0];
                $targetFilePath = $file_name;
                move_uploaded_file($_FILES['images1']['tmp_name'][0], $targetFilePath);
                $conn->query("UPDATE building_images SET image1 = '$targetFilePath' WHERE bid = '$propertyId'");
            }

            if (!empty($_FILES['images2']['name'][0])) {
                $file_name = $_FILES['images2']['name'][0];
                $targetFilePath = $file_name;
                move_uploaded_file($_FILES['images2']['tmp_name'][0], $targetFilePath);
                $conn->query("UPDATE building_images SET image2 = '$targetFilePath' WHERE bid = '$propertyId'");
            }

            if (!empty($_FILES['images3']['name'][0])) {
                $file_name = $_FILES['images3']['name'][0];
                $targetFilePath = $file_name;
                move_uploaded_file($_FILES['images3']['tmp_name'][0], $targetFilePath);
                $conn->query("UPDATE building_images SET image3 = '$targetFilePath' WHERE bid = '$propertyId'");
            }

            // Set success message in session
            $_SESSION['success_message'] = "Property and images uploaded successfully.";

            // Redirect to the same page after successful form submission
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
    }
    $conn->close();
}

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
    <title>Add Property</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        form input,
        form textarea,
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 5px;
        }

        ul li:last-child {
            margin-bottom: 0;
        }

        /* Custom modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            text-align: center;
            border-radius: 10px; /* Added to make the modal box square-shaped */
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>

    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-4ayA5WUNhz4GNxQ5XiyWJTna7/aB9/ejTp2MhN5pIG/QJT6z8e+25fLvl4CcGb7bKAAStEVpWtd5aQEGm7rpxQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <h1>
        <center>Add Property</center>
    </h1><br>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- Form fields... -->
        <label for="areainsqft">Area in Square Feet</label>
        <input type="text" name="areainsqft" id="areainsqft" placeholder="Eg: 2200 SQFT" required><br><br>

        <label for="bathrooms">No of Bathrooms:</label>
        <input name="bathrooms" id="bathrooms" required></input><br><br>

        <label for="bedrooms">No of Bedrooms</label>
        <input type="number" name="bedrooms" id="bedrooms" required><br><br>

        <label for="floor">No of Floors</label>
        <input type="number" name="floor" id="floor" required><br><br>

        <label for="roof">Roofing Type</label>
        <input type="text" name="roof" id="roof" required><br><br>

        <label for="age">Age of the Building</label>
        <input type="number" name="age" id="age" required><br><br>

        <label for="price">Price of the building</label>
        <input type="number" name="price" id="price" required><br><br>

        <label for="condition">Condition of the Building</label>
        <input type="text" name="condition" id="condition" required>
        <br><br>

        <label for="building_type">Building Type</label>
        <select name="building_type" id="building_type" required>
            <option value="" disabled selected>Select a category</option>
            <option value="apartment">Apartment</option>
            <option value="villa">Villa</option>
            <option value="house">House</option>
            <option value="shop">Shop</option>
        </select>
        <br><br>

        <label for="address">address:</label>
        <textarea type="text" name="address" id="address" required></textarea>
        <br><br>


        <label for="city">city</label>
        <input type="text" name="city" id="city" required><br><br>

        <label for="state">state</label>
        <input type="text" name="state" id="state" required><br><br>

        <label for="description">Description:</label>
        <textarea type="text" name="description" id="description" required></textarea>
        <br><br>

        <label for="product_images">Main Image:</label>
        <input type="file" name="images[]" id="images" accept="image/*" multiple><br><br>

        <label for="product_images">Additional Images:</label>
        <input type="file" name="images1[]" id="images1" accept="image/*" multiple><br><br>
        <input type="file" name="images2[]" id="images2" accept="image/*" multiple><br><br>
        <input type="file" name="images3[]" id="images3" accept="image/*" multiple><br><br>

        <input type="submit" value="Add Property">
    </form>

    <!-- JavaScript to close modal on 'OK' button click -->
    <script>
        function closeModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
        }
    </script>
</body>

</html>