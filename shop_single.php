<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PRODEAL</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
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


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">


    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    

</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="about.php" class="nav-link">About</a>
                        </li>
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

 <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="shop.html">Shop</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Marshall</strong></div>
        </div>
      </div>
    </div>  
    <div id="item-container-1" style="display: none;">
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6" style="border-right: 1px solid #2e2e2e;">
            <img id="main-image" src="img/property-1.jpg" alt="Image" class="img-fluid">
            <br><br>
            <div class="row">
              <div class="col-md-4">
                  <img src="img/property-1.jpg" alt="Image 2" class="img-fluid thumb" data-src="img/property-1.jpg" style="width: 150px; height: 100px;">
              </div>
              <div class="col-md-4">
                  <img src="images/marshall1_sub.png" alt="Image 3" class="img-fluid thumb" data-src="images/marshall1_sub.jpg" style="width: 150px; height: 100px;">
              </div>
              <div class="col-md-4">
                  <img src="images/marshall2_sub.png" alt="Image 4" class="img-fluid thumb" data-src="images/marshall2_sub.jpg" style="width: 150px; height: 100px;">
              </div>
          </div>
          </div>
          <div class="col-md-6" style="overflow-y: auto;">
            <h2 class="text-black">Golden Urban House</h2>
            <p style="color: black;">Loud things come in small packages. Acton III is the most discreet Bluetooth speaker in the home line-up and has an even wider soundstage .</p>
            <p class="mb-4" style="color: black;">Ex numquam veritatis debitis minima quo error quam eos dolorum quidem perferendis. Quos repellat dignissimos minus, eveniet nam voluptatibus molestias omnis reiciendis perspiciatis illum hic magni iste, velit aperiam quis.</p>
            <p><strong class="text-primary h3">M.R.P ₹12,345</strong></p>
            <div class="mb-5">
              <div class="input-group mb-3" style="max-width: 120px;">
              
            </div>

            </div>
            <div class="container">
              <p class="h3" style="color: black;">Product Specifications</p>
              <table style="color: black; border: 1px solid black;">
                  <tr>
                      <th style="border: 1px solid black;  text-align: center;">Category</th>
                      <th style="border: 1px solid black;  text-align: center;">Specification</th>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;">General</td>
                      <td style="border: 1px solid black;  text-align: center;">Product Name: Example Product</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;"></td>
                      <td style="border: 1px solid black;  text-align: center;">Model: ABC-123</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;">Features</td>
                      <td style="border: 1px solid black;  text-align: center;">Screen Size: 15 inches</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black; text-align: center;"></td>
                      <td style="border: 1px solid black;  text-align: center;">Processor: Quad-core 2.0 GHz</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;">Connectivity</td>
                      <td style="border: 1px solid black;  text-align: center;">Wi-Fi: 802.11ac</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;"></td>
                      <td style="border: 1px solid black;  text-align: center;">Bluetooth: 5.0</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;">Other Details</td>
                      <td style="border: 1px solid black;  text-align: center;">Dimensions: 13.5" x 9.5" x 0.75"</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;"></td>
                      <td style="border: 1px solid black;  text-align: center;">Weight: 3.5 lbs</td>
                  </tr>
              </table>
         </div>

          </div>
        </div>
      </div>
    <div id="item-container-2" style="display: none;">
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <img id="main-image" src="img/property-2.jpg" alt="Image" class="img-fluid">
            <br><br>
            <div class="row">
              <div class="col-md-4">
                  <img src="images/marshall  headphone.jpg" alt="Image 2" class="img-fluid thumb" data-src="images/marshall  headphone.jpg" style="width: 150px; height: 100px;">
              </div>
              <div class="col-md-4">
                  <img src="images/motif1_sub.png" alt="Image 3" class="img-fluid thumb" data-src="images/motif1_sub.png" style="width: 150px; height: 100px;">
              </div>
              <div class="col-md-4">
                  <img src="images/motif2_sub.png" alt="Image 4" class="img-fluid thumb" data-src="images/motif2_sub.png" style="width: 150px; height: 100px;">
              </div>
          </div>
          </div>
          <div class="col-md-6">
            <h2 class="text-black">MOTIF II A.N.C</h2>
            <p style="color: black;">Motif II A.N.C. offers huge sound, in a tiny package. Its sleek charging case packs a punch by powering your headphones with 30 hours of wireless playtime.</p>
            <p class="mb-4" style="color: black;">Ex numquam veritatis debitis minima quo error quam eos dolorum quidem perferendis. Quos repellat dignissimos minus, eveniet nam voluptatibus molestias omnis reiciendis perspiciatis illum hic magni iste, velit aperiam quis.</p>
            <p><strong class="text-primary h3">M.R.P ₹19,999</strong></p>
           
            <div class="container">
              <p class="h3" style="color: black;">Product Specifications</p>
              <table style="color: black; border: 1px solid black;">
                  <tr>
               
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;">General</td>
                      <td style="border: 1px solid black;  text-align: center;">Product Name: Example Product</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;"></td>
                      <td style="border: 1px solid black;  text-align: center;">Model: ABC-123</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;">Features</td>
                      <td style="border: 1px solid black;  text-align: center;">Screen Size: 15 inches</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black; text-align: center;"></td>
                      <td style="border: 1px solid black;  text-align: center;">Processor: Quad-core 2.0 GHz</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;">Connectivity</td>
                      <td style="border: 1px solid black;  text-align: center;">Wi-Fi: 802.11ac</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;"></td>
                      <td style="border: 1px solid black;  text-align: center;">Bluetooth: 5.0</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;">Other Details</td>
                      <td style="border: 1px solid black;  text-align: center;">Dimensions: 13.5" x 9.5" x 0.75"</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;"></td>
                      <td style="border: 1px solid black;  text-align: center;">Weight: 3.5 lbs</td>
                  </tr>
              </table>
         </div>

          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="item-container-3" style="display: none;">
      <div class="site-section">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <img src="images/computer accesories.jpg" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6">
              <h2 class="text-black">TP-Link 16 Port</h2>
              <p style="color: black;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, vitae, explicabo? Incidunt facere, natus soluta dolores iusto! Molestiae expedita veritatis nesciunt doloremque sint asperiores fuga voluptas, distinctio, aperiam, ratione dolore.</p>
              <p class="mb-4" style="color: black;">Ex numquam veritatis debitis minima quo error quam eos dolorum quidem perferendis. Quos repellat dignissimos minus, eveniet nam voluptatibus molestias omnis reiciendis perspiciatis illum hic magni iste, velit aperiam quis.</p>
              <p><strong class="text-primary h3">M.R.P ₹9,999</strong></p>
              <div class="mb-5">
                <div class="input-group mb-3" style="max-width: 120px;">
                <div class="input-group-prepend">
                  <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                </div>
                <input type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                <div class="input-group-append">
                  <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                </div>
              </div>
  
              </div>
              <p><a href="cart.html" class="buy-now btn btn-sm btn-primary">Add To Cart</a></p>
  
            </div>
          </div>
        </div>
      </div>

  <div id="item-container-4" style="display: none;">    
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <img src="images/phone.jpg" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-6">
            <h2 class="text-black">Lava Blaze 5G</h2>
            <p style="color: black;">The Lava Blaze 5G 128 GB (Glass Green, 8 GB RAM) and delve into a new world of possibilities. The stylish and marvellous design of the phone attracts everyone.</p>
            <p class="mb-4" style="color: black;">Ex numquam veritatis debitis minima quo error quam eos dolorum quidem perferendis. Quos repellat dignissimos minus, eveniet nam voluptatibus molestias omnis reiciendis perspiciatis illum hic magni iste, velit aperiam quis.</p>
            <p><strong class="text-primary h3">M.R.P ₹13,999</strong></p>
            <div class="mb-5">
              <div class="input-group mb-3" style="max-width: 120px;">
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
              </div>
              <input type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
              <div class="input-group-append">
                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
              </div>
            </div>

            </div>
            <p><a href="cart.html" class="buy-now btn btn-sm btn-primary">Add To Cart</a></p>

          </div>
        </div>
      </div>
    </div>
    </div>

    //footer start
    <footer class="site-footer border-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="row">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">Navigations</h3>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="#">Sell online</a></li>
                  <li><a href="#">Features</a></li>
                  <li><a href="#">Shopping cart</a></li>
                  <li><a href="#">Store builder</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="#">Mobile commerce</a></li>
                  <li><a href="#">Dropshipping</a></li>
                  <li><a href="#">Website development</a></li>
                </ul>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="#">Point of sale</a></li>
                  <li><a href="#">Hardware</a></li>
                  <li><a href="#">Software</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
            <h3 class="footer-heading mb-4">Promo</h3>
            <a href="#" class="block-6">
              <img src="images/hero_1.jpg" alt="Image placeholder" class="img-fluid rounded mb-4">
              <h3 class="font-weight-light  mb-0">Finding Your Perfect Shoes</h3>
              <p>Promo from  nuary 15 &mdash; 25, 2019</p>
            </a>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address">203 Fake St. Mountain View, San Francisco, California, USA</li>
                <li class="phone"><a href="tel://23923929210">+2 392 3929 210</a></li>
                <li class="email">emailaddress@domain.com</li>
              </ul>
            </div>

            <div class="block-7">
              <form action="#" method="post">
                <label for="email_subscribe" class="footer-heading">Subscribe</label>
                <div class="form-group">
                  <input type="text" class="form-control py-4" id="email_subscribe" placeholder="Email">
                  <input type="submit" class="btn btn-sm btn-primary" value="Send">
                </div>
              </form>
            </div>  
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" class="text-primary">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
          
        </div>
      </div>
    </footer>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
    

  <script>
    // Function to parse query parameters
    function getQueryParam(param) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    // Get the "item" query parameter
    const itemParam = getQueryParam("item");

    // Define an array of item data (you can fetch this from an API or database)
    const items = [
        {
            title: "Marshall Acton III 60W Bluetooth Speaker",
            description: "Loud things come in small packages. Acton III is the most discreet Bluetooth speaker in the home line-up and has an even wider soundstage .",
            description1: "Ex numquam veritatis debitis minima quo error quam eos dolorum quidem perferendis. Quos repellat dignissimos minus, eveniet nam voluptatibus molestias omnis reiciendis perspiciatis illum hic magni iste, velit aperiam quis.",
            price: "₹31,999",
            image: "img/property-1.jpg",
        },
        {
            title: "MOTIF II A.N.C.",
            description: "Motif II A.N.C. offers huge sound, in a tiny package. Its sleek charging case packs a punch by powering your headphones with 30 hours of wireless playtime.",
            description1: "Ex numquam veritatis debitis minima quo error quam eos dolorum quidem perferendis. Quos repellat dignissimos minus, eveniet nam voluptatibus molestias omnis reiciendis perspiciatis illum hic magni iste, velit aperiam quis.",
            price: "₹19,999",
            image: "img/property-6.jpg",
        },
        {
          title: "TP-Link 16 Port",
          description: "TP-Link 16 Port Gigabit PoE Switch 8 PoE Port+ @150W Easy Smart Plug & Play Sturdy Metal w/Shielded Ports Support QoS, Vlan, IGMP and Link Aggregation.",
          description1: "Ex numquam veritatis debitis minima quo error quam eos dolorum quidem perferendis. Quos repellat dignissimos minus, eveniet nam voluptatibus molestias omnis reiciendis perspiciatis illum hic magni iste, velit aperiam quis.",
          price: "₹9,999",
          image: "images/computer accesories.jpg",
        },
        {
          title: "Lava Blaze 5G",
          description: "Buy the Lava Blaze 5G 128 GB (Glass Green, 8 GB RAM) and delve into a new world of possibilities. The stylish and marvellous design of the phone attracts everyone.",
          description1: "Ex numquam veritatis debitis minima quo error quam eos dolorum quidem perferendis. Quos repellat dignissimos minus, eveniet nam voluptatibus molestias omnis reiciendis perspiciatis illum hic magni iste, velit aperiam quis.",
          price: "₹13,999",
          image: "images/phone.jpg",
        },

    ];

    // Function to display item details
    function displayItem(itemIndex) {
        const item = items[itemIndex];
        const itemContainer = document.getElementById("item-container");

        const itemHTML = `
        <div id="item-container">
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6"  style="border-right: 1px solid #2e2e2e;">
            <img id="main-image" src="${item.image}" alt="Image" class="img-fluid">
            <br><br>
            <div class="row">
              <div class="col-md-4">
                  <img src="images/marshall_sub.png" alt="Image 2" class="img-fluid thumb" data-src="images/marshall_sub.png" style="width: 150px; height: 100px;">
              </div>
              <div class="col-md-4">
                  <img src="images/marshall1_sub.png" alt="Image 3" class="img-fluid thumb" data-src="images/marshall1_sub.png" style="width: 150px; height: 100px;">
              </div>
              <div class="col-md-4">
                  <img src="images/marshall2_sub.png" alt="Image 4" class="img-fluid thumb" data-src="images/marshall2_sub.png" style="width: 150px; height: 100px;">
              </div>
          </div>
            </div>
          <div class="col-md-6" style="overflow-y: auto;">
                    <h3 style="color: black;">${item.title}</h3>
                    <p style="color: black;">${item.description}</p>
            <p class="mb-4" style="color: black;">${item.description1}</p>
                    <p><strong class="text-primary h3">M.R.P ${item.price}</strong></p>
                    <div class="mb-5">
              <div class="input-group mb-3" style="max-width: 120px;">
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
              </div>
              <input type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
              <div class="input-group-append">
                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
              </div>
            </div>

            </div>
            <p><a href="cart.html" class="buy-now btn btn-sm btn-primary">Add To Cart</a>
              <a href="buy.html" class="buy-now btn btn-sm btn-primary">Buy Now</a>
              </p>
              <div class="container">
              <p class="h3" style="color: black;">Product Specifications</p>
              <table style="color: black; border: 1px solid black;">
                  <tr>
                      <th style="border: 1px solid black;  text-align: center;">Category</th>
                      <th style="border: 1px solid black;  text-align: center;">Specification</th>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;">General</td>
                      <td style="border: 1px solid black;  text-align: center;">Product Name: Example Product</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;"></td>
                      <td style="border: 1px solid black;  text-align: center;">Model: ABC-123</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;">Features</td>
                      <td style="border: 1px solid black;  text-align: center;">Screen Size: 15 inches</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black; text-align: center;"></td>
                      <td style="border: 1px solid black;  text-align: center;">Processor: Quad-core 2.0 GHz</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;">Connectivity</td>
                      <td style="border: 1px solid black;  text-align: center;">Wi-Fi: 802.11ac</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;"></td>
                      <td style="border: 1px solid black;  text-align: center;">Bluetooth: 5.0</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;">Other Details</td>
                      <td style="border: 1px solid black;  text-align: center;">Dimensions: 13.5" x 9.5" x 0.75"</td>
                  </tr>
                  <tr>
                      <td style="border: 1px solid black;  text-align: center;"></td>
                      <td style="border: 1px solid black;  text-align: center;">Weight: 3.5 lbs</td>
                  </tr>
              </table>
         </div>

          </div>
        </div>
      </div>
    </div>
   </div>
  </div>
        `;

        itemContainer.innerHTML = itemHTML;
    }

    // Check if "item" query parameter is provided and load the corresponding item
    if (itemParam) {
        const itemIndex = parseInt(itemParam) - 1; // Adjust index (1-based to 0-based)
        if (!isNaN(itemIndex) && itemIndex >= 0 && itemIndex < items.length) {
            displayItem(itemIndex);
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.getElementById('main-image');
    const thumbnails = document.querySelectorAll('.thumb');

    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            // Change the main image source to the clicked thumbnail's data-src
            mainImage.style.opacity = '0';
            setTimeout(function() {
                mainImage.src = thumb.getAttribute('data-src');
                mainImage.style.opacity = '1';
            }, 300);

            // Remove the 'active' class from all thumbnails
            thumbnails.forEach(t => t.classList.remove('active'));

            // Add the 'active' class to the clicked thumbnail
            thumb.classList.add('active');
        });
    });
});

</script>
<script>

        // Function to extract query parameters from the URL
        function getQueryParam(parameter) {
            var urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(parameter);
        }

        // Check if the URL contains the 'show' parameter with the value '1' or '2'
        var showParam = getQueryParam('show');
        if (showParam === '1') {
            // Show the first item container
            document.getElementById('item-container-1').style.display = 'block';
        } else if (showParam === '2') {
            // Show the second item container
            document.getElementById('item-container-2').style.display = 'block';
        } else if (showParam === '3') {
            // Show the second item container
            document.getElementById('item-container-3').style.display = 'block';
        } else if (showParam === '4') {
            // Show the second item container
            document.getElementById('item-container-4').style.display = 'block';
        }       
    </script>


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