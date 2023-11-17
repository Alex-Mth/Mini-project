<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="prodeal";

$conn= new mysqli($dbhost,$dbuser,$dbpass,$dbname);

if ($conn->connect_error)
{
    die("Connection failed: ".$conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>PRODEAL</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
    rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="css/style.css" rel="stylesheet">

</head>

<body>
  <div class="container-xxl bg-white p-0">
    <!-- Navbar Start -->
    <div class="container-fluid nav-bar bg-transparent">
      <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
        <a href="index.html" class="navbar-brand d-flex align-items-center text-center">
          <div class="icon p-2 me-2">
            <img class="img-fluid" src="img/icon-deal.png" alt="Icon" style="width: 30px; height: 30px;">
          </div>
          <h1 class="m-0 text-primary">PRODEAL</h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a href="index.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="about.php" class="nav-link">About</a>
            </li>
            <?php
            session_start();

            if (isset($_SESSION['username'])) {
              echo '<div class="nav-item dropdown">';
              echo '<a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $_SESSION['username'] . '</a>';
              echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
              echo '<a href="logout.php" class="dropdown-item">Logout</a>';
              echo '<a href="profile.php" class="dropdown-item">Profile</a>';
              echo '</div>';
              echo '</div>';
            } else {
              echo '<a href="signin.php" class="nav-item nav-link">Sign in</a>';
            }
            ?>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Property</a>
              <div class="dropdown-menu rounded-0 m-0">
                <a href="index.php#emu" class="dropdown-item">Property List</a>
                <a href="index.php#agent" class="dropdown-item">Property Agent</a>
              </div>
            </li>
            <li class="nav-item">
              <a href="contact.php" class="nav-link">Contact</a>
            </li>
          </ul>
          <a href="" class="btn btn-primary px-3 d-none d-lg-flex">Add Property</a>
        </div>
      </nav>
    </div>
    <!-- Navbar End -->
    <?php
include 'config.php';

// Check if the property ID is set in the URL
if (isset($_GET['show'])) {
    $propertyId = $_GET['show'];

    // Fetch property details from the database based on the property ID
    $propertySql = "SELECT * FROM building WHERE bid = '$propertyId'";
    $propertyResult = $conn->query($propertySql);

    if ($propertyResult->num_rows > 0) {
        $propertyRow = $propertyResult->fetch_assoc();
        $area = $propertyRow['areainsqft'];
        $price = $propertyRow['price'];
        $buildingType = $propertyRow['building_type'];
        $address = $propertyRow['address'];
        $bedrooms = $propertyRow['bedrooms'];
        $bathrooms = $propertyRow['bathrooms'];
        $desc = $propertyRow['description'];

        // Output the property data in the desired style
        $imageSql = "SELECT image, image1, image2, image3 FROM building_images WHERE bid = '$propertyId'";
        $imageResult = $conn->query($imageSql);
        $imageRow = $imageResult->fetch_assoc();
        $imageUrl = $imageRow['image'];
        $imageUrl1 = isset($imageRow['image1']) ? $imageRow['image1'] : '';
        $imageUrl2 = isset($imageRow['image2']) ? $imageRow['image2'] : '';
        $imageUrl3 = isset($imageRow['image3']) ? $imageRow['image3'] : '';

        // Fetch booking details from the database based on the property ID
        $bookingSql = "SELECT * FROM booking WHERE bid = '$propertyId'";
        $bookingResult = $conn->query($bookingSql);

        if ($bookingResult->num_rows > 0) {
            $bookingRow = $bookingResult->fetch_assoc();
            $end_date = $bookingRow['end_date'];
            $current_date = date("Y-m-d");

            echo "<div class='site-section'>
                    <div class='container'>
                        <div class='row'>
                            <div class='col-md-6' style='border-right: 1px solid #2e2e2e;'>
                        <img id='main-image' src='$imageUrl' alt='Image' class='img-fluid'>
                        <br><br>
                        <div class='row'>
                            <div class='col-md-4'>
                                <img src='" . ($imageUrl1 ? $imageUrl1 : '') . "' alt='Image 2' class='img-fluid thumb' data-src='" . ($imageUrl1 ? $imageUrl1 : '') . "' style='width: 150px; height: 100px;'>
                            </div>
                            <div class='col-md-4'>
                                <img src='" . ($imageUrl2 ? $imageUrl2 : '') . "' alt='Image 3' class='img-fluid thumb' data-src='" . ($imageUrl2 ? $imageUrl2 : '') . "' style='width: 150px; height: 100px;'>
                            </div>
                            <div class='col-md-4'>
                                <img src='" . ($imageUrl3 ? $imageUrl3 : '') . "' alt='Image ' class='img-fluid thumb' data-src='" . ($imageUrl3 ? $imageUrl3 : '') . "' style='width: 150px; height: 100px;'>
                            </div>
                        </div>
                        </div>
                        <div class='col-md-6' style='overflow-y: auto;'>
                        <h2 class='text-black'>$buildingType</h2>
                        <p style='color: black;'>$desc<br>
                         <strong> M.R.P ₹" . number_format($price) . "</strong></p>
                         <div class='mb-5'>
                         <div class='input-group mb-3' style='max-width: 120px;'></div>
                     </div>";

 // Check if 'end_date' is in the future (greater than the current date)
 if (strtotime($end_date) > strtotime(date("Y-m-d"))) {
     // Property is booked, don't show the booking button
     echo "<p>This property is already booked.</p>";
 } else {
     // Property is not booked, show the booking button
     // Redirect to the booking form
     echo "<a class='btn btn-primary py-3 px-4 mt-3' href='booking.php?bid=$propertyId'>Book Now</a>";
 }

 echo "</div>
     </div>
 </div>";
} else {
 // Property is not yet available for booking
 echo "This property is not available for booking until the specified end date.";
}
} else {
echo "No properties found.";
}
} else {
echo "Invalid property ID.";
}

$conn->close();
?>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var mainImage = document.getElementById('main-image');
        var thumbnailImages = document.querySelectorAll('.thumb');

        thumbnailImages.forEach(function (thumbnail) {
          thumbnail.addEventListener('click', function () {
            var clickedImageUrl = this.getAttribute('data-src');
            var mainImageUrl = mainImage.src;

            mainImage.src = clickedImageUrl;

            this.setAttribute('data-src', mainImageUrl);
            this.src = mainImageUrl;
          });
        });
      });
    </script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
  </div>
</body>

</html>