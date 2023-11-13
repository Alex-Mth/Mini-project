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
    $age = $_POST['age'];
    $condition = $_POST['condition'];
    $btype = $_POST['building_type'];

    // Validate form data (check for empty fields)
    if (empty($area) || empty($desc) || empty($bedroom) || empty($bathroom) || empty($floor) || empty($roof) || empty($age) || empty($condition) || empty($btype)) {
        echo "All fields are required.";
    } else {
        // Insert property details into the database
        $sql = "INSERT INTO building (areainsqft, description, bedrooms, bathrooms, floor, roof, age, `condition`, building_type) VALUES ('$area', '$desc', '$bedroom', '$bathroom', '$floor', '$roof', '$age', '$condition', '$btype')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
            if (isset($_FILES['image'])) {
                foreach ($_FILES['image']['tmp_name'] as $key => $tmp_name) {
                    $file_name = $_FILES['image']['name'][$key];
                    $targetFilePath = $file_name;
                    move_uploaded_file($tmp_name, $targetFilePath);
                    $imageData = file_get_contents($targetFilePath);
                    $escapedImageData = $conn->real_escape_string($imageData);

                    // Insert image data into the database with the associated property ID
                    $imageSql = "INSERT INTO building_images (bid, image) VALUES ('$propertyId', '$escapedImageData')";
                    if ($conn->query($imageSql) !== TRUE) {
                        echo "Error: " . $imageSql . "<br>" . $conn->error;
                    }
                }
            }

            echo "Property and images uploaded successfully.";
        }
    }
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Insert Product</title>
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

        /* Modal styles */
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
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: #fefefe;
            border: 1px solid #888;
            width: 200px;
            /* Set the width of the modal */
            height: 200px;
            /* Set the height of the modal */
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .close {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        .close:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>
        <center>Add Property</center>
    </h1><br>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="areainsqft">Area in Square Feet</label>
        <input type="text" name="areainsqft" id="areainsqft" placeholder="Eg: 2200 SQFT" required><br><br>

        <label for="bathrooms">No of Bathrooms: </label>
        <input name="bathrooms" id="bathrooms" required></input><br><br>

        <label for="bedrooms">No of Bedrooms</label>
        <input type="number" name="bedrooms" id="bedrooms" required><br><br>

        <label for="floor">No of Floors</label>
        <input type="number" name="floor" id="floor" required><br><br>

        <label for="roof">Roofing Type</label>
        <input type="text" name="roof" id="roof" required><br><br>

        <label for="age">Age of the Building</label>
        <input type="text" name="age" id="age" required><br><br>

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

        <label for="brand">Description:</label>
        <textarea type="text" name="description" id="description" required></textarea>
        <br><br>

        <label for="product_images">Images:</label>
        <input type="file" name="image[]" id="image" accept="image/*" multiple><br><br>

        <input type="submit" value="Add Property">
    </form>

</body>

</html>