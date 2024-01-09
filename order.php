<?php
// Start the session at the beginning of the file
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Include the config file
include 'config.php';

// Debug: Display session dat


// Get the user's ID
$username = $_SESSION['username'];

// Debug: Display user ID


// Fetch booking details for the current user
$bookingSql = "SELECT booking.*, building.address, building.price
               FROM booking
               JOIN building ON booking.bid = building.bid
               WHERE booking.username = '$username'";

$bookingResult = $conn->query($bookingSql);

if ($bookingResult->num_rows > 0) {
    while ($bookingRow = $bookingResult->fetch_assoc()) {
        // Access the booking details and additional information here
        $bookingId = $bookingRow['booking_id'];
        $propertyAddress = $bookingRow['address'];
        $propertyPrice = $bookingRow['price'];
        // ... other booking details
    }
    // Rest of your code for displaying or processing the booking details
} else {
    echo "No bookings found for the user.";
}
?>

<!-- The rest of your HTML code here -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PRODEAL - Orders</title>
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

    <!-- Your Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

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

                    // Check if the user is logged in (adjust this condition based on your authentication logic)
                    if (isset($_SESSION['username'])) {
                        // Display the user's username in a dropdown
                        echo '<div class="nav-item dropdown">';
                        echo '<a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $_SESSION['username'] . '</a>';
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

    <div class="container-xxl bg-white p-0">
        <!-- Content section -->
        <div class="container mt-5">
            <h2>Your Orders</h2>
<br><br>
            <div class="container" id="emu">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        <div class="row g-4">
                        <div class="row mb-5">
                    <form class="col-md-12" method="post">
                        <div class="site-blocks-table">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name">Address</th>
                                        <th class="product-quantity">Building type</th>
                                        <th class="product-total">Price</th>
                                        <th class="product-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
global $productId;

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $ordersQuery = "SELECT  o.username, b.address, b.building_type, b.price, i.image
    FROM `order` o
    JOIN building b ON o.bid = b.bid
    JOIN building_images i ON o.bid = i.bid
    WHERE o.username = ?";
    $stmt = $conn->prepare($ordersQuery);

    if ($stmt) {
        $stmt->bind_param("s", $_SESSION['username']);
        $stmt->execute();
        $ordersResult = $stmt->get_result();

        if (!empty($ordersResult) && $ordersResult->num_rows > 0) {
            while ($row = $ordersResult->fetch_assoc()) {
                $productImage = $row['image'];
                $productName = $row['address'];
                $quantity = $row['building_type'];
                $price = $row['price'];

                echo "<tr>
                        <td><img src='$productImage' alt='$productName' style='max-width: 100px; max-height: 100px;'></td>
                        <td>$productName</td>
                        <td>$quantity</td>
                        <td>₹$price</td>
                        <td><a href='#' class='btn btn-primary btn-sm remove-item' data-toggle='modal' data-target='#confirmationModal'>X</a></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Your order history is empty.</td></tr>";
        }
        $stmt->close();
    } else {
        echo "<tr><td colspan='6'>Error in preparing statement.</td></tr>";
    }
} else {
    echo "<tr><td colspan='6'>User not logged in.</td></tr>";
}
?>


                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>

                    </div>
                </div>
            </div>



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
                                <a class="btn btn-outline-light btn-social" href=""><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                                <a class="btn btn-outline-light btn-social" href=""><i
                                        class="fab fa-linkedin-in"></i></a>
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
            </div>
            <!-- Footer End -->

            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

            <!-- Include your scripts here -->
            <!-- ... -->

            <!-- Favicon -->
            <link href="img/favicon.ico" rel="icon">

            <!-- Google Web Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link
                href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
                rel="stylesheet">

            <!-- Icon Font Stylesheet -->
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

            <!-- JavaScript Libraries -->
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="lib/wow/wow.min.js"></script>
            <script src="lib/easing/easing.min.js"></script>
            <script src="lib/waypoints/waypoints.min.js"></script>
            <script src="lib/owlcarousel/owl.carousel.min.js"></script>

            <!-- Template Javascript -->
            <script src="js/main.js"></script>

     <!-- ... Your HTML code above ... -->

     <script>
    document.addEventListener("DOMContentLoaded", function() {
        const removeButtons = document.querySelectorAll(".remove-item");

        removeButtons.forEach(function(button) {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                const productId = this.getAttribute('data-product-id');
                const tableRow = document.querySelector(tr[data-product-id='${productId}']);
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to remove the item?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "removeitem.php",
                            data: {
                                product_id: bid
                            },
                            success: function(response) {
                                console.log("Item removed from the cart!");
                                Swal.fire('Removed!',
                                        'The item has been removed from the cart.',
                                        'success')
                                    .then(() => {
                                        location.reload(true);
                                    });
                            },
                            error: function(xhr, status, error) {
                                console.error("Error:", error);
                                Swal.fire('Error!',
                                    'There was an error removing the item.',
                                    'error');
                            }
                        });
                    }
                });
            });
        });
    });
    </script>



</body>

</html>
<?php
// Close the database connection
$conn->close();
?>