<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PRODEAL </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<style>
    /* Add custom styles for the dropdown */
    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
    }

    .property-item img {
        width: 100%;
        height: 200px;
        /* Set the desired height for your images */
        object-fit: cover;
        /* This property ensures the image covers the entire container */
    }
</style>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


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
                    <div class="navbar-nav ms-auto">
                        <a href="index.html" class="nav-item nav-link active">Home</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="shop.php" class="nav-item nav-link">Shop</a>
                        <?php
                        session_start();

                        // Check if the user is logged in (adjust this condition based on your authentication logic)
                        if (isset($_SESSION['username'])) {
                            // Display the user's username in a dropdown
                            echo '<div class="nav-item dropdown">';
                            echo '<a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $_SESSION['username'] . '</a>';
                            echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                            echo '<a href="logout.php" class="dropdown-item">Logout</a>';
                            echo '<a href="profile.php" class="dropdown-item">Profile</a>';
                            echo '</div>';
                            echo '</div>';
                        } else {
                            // Display the "Sign in" link
                            echo '<a href="signin.php" class="nav-item nav-link">Sign in</a>';
                        }
                        ?>


                        <script>
                            function logout() {
                                // Redirect to the logout script
                                window.location.href = "logout.php";
                            }
                        </script>

                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Property</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="#agent" class="dropdown-item">Property Agent</a>
                            </div>
                        </div>
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
                    </div>
                    <a href="addproperty.php" class="btn btn-primary px-3 d-none d-lg-flex">Add Property</a>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->


<?php
// Check if the 'type' parameter is set in the URL
if (isset($_GET['type'])) {
    $propertyType = $_GET['type'];}

    // Fetch properties based on the selected property type
    $query = "SELECT * FROM building WHERE building_type = '$propertyType'";
    $result = $conn->query($query);

    // Display the filtered properties
    echo '<div class="container-xxl py-5">';
    echo '<div class="container" id="emu">';
    echo '<div class="tab-content">';
    echo '<div id="tab-1" class="tab-pane fade show p-0 active">';
    echo '<div class="row g-4">';

    // Check if there are properties matching the filter
    if ($result->num_rows > 0) {
       // ... (previous code)

    while ($property = $result->fetch_assoc()) {
        // Extract property details
        $propertyId = $property['bid'];
        $area = $property['areainsqft'];
        $price = $property['price'];
        $buildingType = $property['building_type'];
        $address = $property['address'];
        $bedrooms = $property['bedrooms'];
        $bathrooms = $property['bathrooms'];
        $desc = $property['description'];
        $city = $property['city'];

        $bookingsql = "SELECT * FROM booking WHERE bid = '$propertyId'";
        $bookingResult = $conn->query($bookingsql);

        if ($bookingResult->num_rows > 0) {
            $bookingRow = $bookingResult->fetch_assoc();
            $isBooked = true; // Property is booked
            $end_date = $bookingRow['end_date']; // Replace with the actual end_date from your database

            // If the property is not booked or the end_date is in the future, display it
            if (!$isBooked || strtotime($end_date) < strtotime(date("Y-m-d"))) {
                // Fetch property image URL
                $imageSql = "SELECT image FROM building_images WHERE bid = '$propertyId'";
                $imageResult = $conn->query($imageSql);
                $imageRow = $imageResult->fetch_assoc();
                $imageUrl = $imageRow['image'];

                // Output the property data in the desired style
                echo "<div class='col-lg-4 col-md-6 wow fadeInUp' data-wow-delay='0.1s'>
                    <div class='property-item rounded overflow-hidden'>
                        <div class='position-relative overflow-hidden'>
                            <a href='shop_single.php?show=$propertyId'><img class='img-fluid' src='$imageUrl' alt=''></a>
                            <div class='bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3'>$buildingType</div>
                        </div>
                        <div class='p-4 pb-0'>
                            <h5 class='text-primary mb-3'>$" . number_format($price) . "</h5>
                            <a class='d-block h5 mb-2' href='shop_single.php?show=$propertyId'>$address</a>
                            <p><i class='fa fa-map-marker-alt text-primary me-2'></i>$city Sqft</p>
                            <p><i class='fa fa-map-marker-alt text-primary me-2'></i>$area Sqft</p>
                        </div>
                        <div class='d-flex border-top'>
                            <small class='flex-fill text-center border-end py-2'><i class='fa fa-bed text-primary me-2'></i>$bedrooms Bed</small>
                            <small class='flex-fill text-center py-2'><i class='fa fa-bath text-primary me-2'></i>$bathrooms Bath</small>
                        </div>
                    </div>
                </div>";
            }
        } else {
            // If there are no bookings for the property, display it
            // Output the property data in the desired style
            $imageSql = "SELECT image FROM building_images WHERE bid = '$propertyId'";
            $imageResult = $conn->query($imageSql);
            $imageRow = $imageResult->fetch_assoc();
            $imageUrl = $imageRow['image'];

            echo "<div class='col-lg-4 col-md-6 wow fadeInUp' data-wow-delay='0.1s'>
                    <div class='property-item rounded overflow-hidden'>
                        <div class='position-relative overflow-hidden'>
                            <a href='shop_single.php?show=$propertyId'><img class='img-fluid' src='$imageUrl' alt=''></a>
                            <div class='bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3'>$buildingType</div>
                        </div>
                        <div class='p-4 pb-0'>
                            <h5 class='text-primary mb-3'>$" . number_format($price) . "</h5>
                            <a class='d-block h5 mb-2' href='shop_single.php?show=$propertyId'>$address</a>
                            <p><i class='fa fa-map-marker-alt text-primary me-2'></i>$area Sqft</p>
                        </div>
                        <div class='d-flex border-top'>
                            <small class='flex-fill text-center border-end py-2'><i class='fa fa-bed text-primary me-2'></i>$bedrooms Bed</small>
                            <small class='flex-fill text-center py-2'><i class='fa fa-bath text-primary me-2'></i>$bathrooms Bath</small>
                        </div>
                    </div>
                </div>";
        }
    }
} else {
    echo "No properties found.";
}

$conn->close();
?>


        <!-- Property List End -->
<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Get In Touch</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Photo Gallery</h5>
                        <div class="row g-2 pt-2">
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-1.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-2.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-3.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-4.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-5.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/property-6.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text"
                                placeholder="Your email">
                            <button type="button"
                                class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
    
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>


    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>