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


        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn mb-4">Find A <span class="text-primary">Perfect Home</span> To
                        Live With Your Family</h1>
                    <p class="animated fadeIn mb-4 pb-2">we believe that real estate is more than just a transaction.
                        It’s a life-changing experience that requires trust, expertise, and passion.</p>
                    <a href="#prop" class="btn btn-primary py-3 px-5 me-3 animated fadeIn">Get Started</a>
                </div>
                <div class="col-md-6 animated fadeIn">
                    <div class="owl-carousel header-carousel">
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="img/carousel-1.jpg" alt="">
                        </div>
                        <div class="owl-carousel-item">
                            <img class="img-fluid" src="img/carousel-2.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->




        <!-- Category Start -->
<!-- HTML code with PHP modifications for filtering -->
<div class="container-xxl py-5">
    <div class="container" id="prop">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">Property Types</h1>
            <p></p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a class="cat-item d-block bg-light text-center rounded p-3" href="filter_properties.php?type=apartment">
                    <div class="rounded p-4">
                        <div class="icon mb-3">
                            <img class="img-fluid" src="img/icon-apartment.png" alt="Icon">
                        </div>
                        <h6>Apartment</h6>
                        <span>123 Properties</span>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a class="cat-item d-block bg-light text-center rounded p-3" href="filter_properties.php?type=villa">
                    <div class="rounded p-4">
                        <div class="icon mb-3">
                            <img class="img-fluid" src="img/icon-villa.png" alt="Icon">
                        </div>
                        <h6>Villa</h6>
                        <span>123 Properties</span>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a class="cat-item d-block bg-light text-center rounded p-3" href="filter_properties.php?type=home">
                    <div class="rounded p-4">
                        <div class="icon mb-3">
                            <img class="img-fluid" src="img/icon-house.png" alt="Icon">
                        </div>
                        <h6>House</h6>
                        <span>123 Properties</span>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <a class="cat-item d-block bg-light text-center rounded p-3" href="filter_properties.php?type=shop">
                    <div class="rounded p-4">
                        <div class="icon mb-3">
                            <img class="img-fluid" src="img/icon-condominium.png" alt="Icon">
                        </div>
                        <h6>Shop</h6>
                        <span>123 Properties</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

        <!-- Category End -->


     

        <!-- Property List Start -->
        <div class="container" id="emu">
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">


                        <?php
                        // Fetch property data from the database
                        $sql = "SELECT * FROM building";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $propertyId = $row['bid'];
                                $area = $row['areainsqft'];
                                $price = $row['price'];
                                $buildingType = $row['building_type'];
                                $address = $row['address'];
                                $bedrooms = $row['bedrooms'];
                                $bathrooms = $row['bathrooms'];
                                $desc=$row['description'];
                                // Output the property data in the desired style
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
                        <p><i class='fa fa-map-marker-alt text-primary me-2'></i>$area Sqft</p>
                    </div>
                    <div class='d-flex border-top'>
                        <small class='flex-fill text-center border-end py-2'><i class='fa fa-bed text-primary me-2'></i>$bedrooms Bed</small>
                        <small class='flex-fill text-center py-2'><i class='fa fa-bath text-primary me-2'></i>$bathrooms Bath</small>
                    </div>
                </div>
            </div>
        ";
                            }
                        } else {
                            echo "No properties found.";
                        }

                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Property List End -->



        <!-- Call to Action Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="bg-light rounded p-3">
                    <div class="bg-white rounded p-4" style="border: 1px dashed rgba(0, 185, 142, .3)">
                        <div class="row g-5 align-items-center">
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                                <img class="img-fluid rounded w-100" src="img/call-to-action.jpg" alt="">
                            </div>
                            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                                <div class="mb-4">
                                    <h1 class="mb-3">Contact With Our Certified Agent</h1>
                                   
                                </div>
                                <a href="" class="btn btn-primary py-3 px-4 me-2"><i
                                        class="fa fa-phone-alt me-2"></i>Make A Call</a>
                                <a href="" class="btn btn-dark py-3 px-4"><i class="fa fa-calendar-alt me-2"></i>Get
                                    Appoinment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to Action End -->


        <!-- Team Start -->
        <div class="container-xxl py-5">
            <div class="container" id="agent">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Property Agents</h1>
                    <p>Professionals who help clients buy, sell, or rent properties, responsible for creating property
                        listings that accurately describe the features and benefits of a property.</p>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/abhijith.jpg" alt="">
                                <div
                                    class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                    <a class="btn btn-square mx-1" href="https://www.facebook.com/profile.php?id=61553145405536&mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square mx-1" href="https://instagram.com/a.bhi_jith?igshid=MXA5NWtpbnRrOGU1bg=="><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">Abhijith Ajithkumar</h5>
                                <small>Founder</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="team-item rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/alex.jpg" alt="">
                                <div
                                    class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                    <a class="btn btn-square mx-1" href="https://www.facebook.com/alex.mathew.98499123?mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square mx-1" href="https://instagram.com/_.alex._mathew_?igshid=OG84YXRkeXQwYnp5"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">Alex Mathew</h5>
                                <small>Founder</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="team-item rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="img/akhil.jpg" alt="">
                                <div
                                    class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                    <a class="btn btn-square mx-1" href="https://www.facebook.com/akhildavid.oz?mibextid=ZbWKwL"><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square mx-1" href="https://instagram.com/akhil_._david?igshid=MTFyemFoN2pvb2puNg=="><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">Akhil David</h5>
                                <small>Founder</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->


        <!-- Testimonial Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">Our Clients Say!</h1>
                   
                </div>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                    <div class="testimonial-item bg-light rounded p-3">
                        <div class="bg-white border rounded p-4">
                            <p>"Thrilled with the seamless experience on the prodeal! User-friendly interface, extensive listings, and prompt support. Found my dream property effortlessly. Highly recommend for hassle-free transactions!"</p>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-1.jpg"
                                    style="width: 45px; height: 45px;">
                                <div class="ps-3">
                                    <h6 class="fw-bold mb-1">Mathew John</h6>
                                    <small>Doctor</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-3">
                        <div class="bg-white border rounded p-4">
                            <p>"I found my dream property on the land dealing website! The user-friendly interface made browsing easy, and the detailed listings provided all the information I needed. Highly recommend!"</p>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-2.jpg"
                                    style="width: 45px; height: 45px;">
                                <div class="ps-3">
                                    <h6 class="fw-bold mb-1">David Mosses</h6>
                                    <small>Engineer</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-3">
                        <div class="bg-white border rounded p-4">
                            <p>"Fantastic experience using the land dealing website. Found the perfect plot quickly with detailed info. Smooth transaction and excellent customer service. A reliable platform for hassle-free land deals. Impressed!"</p>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid flex-shrink-0 rounded" src="img/testimonial-3.jpg"
                                    style="width: 45px; height: 45px;">
                                <div class="ps-3">
                                    <h6 class="fw-bold mb-1">Ajith Raj</h6>
                                    <small>Graphic Designer</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->


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

    <script>
        document.querySelectorAll('a[href^="#prop"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
    <script>
        // JavaScript to handle the "Browse More Property" button click event
        var showHiddenItemsButton = document.getElementById("showHiddenItems");
        var hiddenItems = document.getElementById("hiddenItems");

        showHiddenItemsButton.addEventListener("click", function () {
            // Hide the button and the hidden items
            showHiddenItemsButton.style.display = "none";
            hiddenItems.style.display = "";
        });
    </script>
    // search script
    <script>
        function searchProperties() {
            var searchInput = document.getElementById('searchInput').value.toLowerCase();
            var properties = document.getElementsByClassName('property');

            for (var i = 0; i < properties.length; i++) {
                var propertyName = properties[i].getAttribute('data-name').toLowerCase();

                if (propertyName.includes(searchInput)) {
                    properties[i].classList.remove('hidden');
                } else {
                    properties[i].classList.add('hidden');
                }
            }
        }
    </script>
</body>

</html>