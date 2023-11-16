<?php
include 'config.php';



// Check if the 'type' parameter is set in the URL
if (isset($_GET['type'])) {
    $propertyType = $_GET['type'];

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
        echo "<div class='col-12 text-center'><p>No properties found for the selected type.</p></div>";
    }

    echo '</div>'; // Closing row
    echo '</div>'; // Closing tab-pane
    echo '</div>'; // Closing tab-content
    echo '</div>'; // Closing container
    echo '</div>'; // Closing container-xxl

    $conn->close();
} else {
    // Redirect to the home page if 'type' parameter is not set
    header("Location: index.php");
    exit();
}
?>
