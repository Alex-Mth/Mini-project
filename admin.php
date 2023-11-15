<?php
include('config.php');

// Fetch user details
$userQuery = "SELECT * FROM user";
$userResult = $conn->query($userQuery);

// Fetch property details
$propertyQuery = "SELECT * FROM building";
$propertyResult = $conn->query($propertyQuery);

// Fetch booking details (previously Sale Details)
$bookingQuery = "SELECT booking.*, users.username as user_name, building.building_type FROM bookings
                JOIN users ON booking.user_id = users.id
                JOIN building ON booking.bid = building.id";
$bookingResult = $conn->query($bookingQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            background-color: white;
            font-family: 'Arial', sans-serif;
        }

        h1 {
            color: #00cc00; /* Green */
            font-weight: bold;
        }

        button {
            color: white;
            background-color: #4CAF50; /* Green */
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        button:hover {
            background-color: #45a049; /* Darker Green */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .dashboard-section {
            display: none;
            margin-top: 20px;
        }

        .active {
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <!-- Buttons to toggle sections -->
    <button onclick="showSection('userAccounts')">User Accounts</button>
    <button onclick="showSection('propertyDetails')">Property Details</button>
    <button onclick="showSection('bookingDetails')">Booking Details</button>

    <!-- User Accounts Section -->
    <section class="dashboard-section" id="userAccounts">
        <h2>User Accounts</h2>
        <table>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Password</th>
                <th>Address</th>
            </tr>
            <?php while ($user = $userResult->fetch_assoc()): ?>
                <tr>
                    <td><?= $user['userid'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['phone'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['password'] ?></td>
                    <td><?= $user['address'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </section>

    <!-- Property Details Section -->
    <section class="dashboard-section" id="propertyDetails">
        <h2>Properties</h2>
        <table>
            <tr>
                <th>Property ID</th>
                <th>Area (in sqft)</th>
                <th>Description</th>
                <th>Bedrooms</th>
                <th>Bathrooms</th>
                <th>Floor</th>
                <th>Roof</th>
                <th>Age</th>
                <th>Condition</th>
                <th>Building Type</th>
                <th>Price</th>
                <th>Address</th>
            </tr>
            <?php while ($property = $propertyResult->fetch_assoc()): ?>
                <tr>
                    <td><?= $property['bid'] ?></td>
                    <td><?= $property['areainsqft'] ?></td>
                    <td><?= $property['description'] ?></td>
                    <td><?= $property['bedrooms'] ?></td>
                    <td><?= $property['bathrooms'] ?></td>
                    <td><?= $property['floor'] ?></td>
                    <td><?= $property['roof'] ?></td>
                    <td><?= $property['age'] ?></td>
                    <td><?= $property['condition'] ?></td>
                    <td><?= $property['building_type'] ?></td>
                    <td><?= $property['price'] ?></td>
                    <td><?= $property['address'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </section>

    <!-- Booking Details Section -->
    <section class="dashboard-section" id="bookingDetails">
        <h2>Booking Details</h2>
        <table>
            <tr>
                <th>Username</th>
                <th>Booking Date</th>
                <th>Token Amount</th>
                <th>End Date</th>
                <th>Property ID</th>
                <th>Building Type</th>
                <th>Booking ID</th>
            </tr>
            <?php while ($booking = $bookingResult->fetch_assoc()): ?>
                <tr>
                    <td><?= $booking['username'] ?></td>
                    <td><?= $booking['booking_date'] ?></td>
                    <td><?= $booking['token_amount'] ?></td>
                    <td><?= $booking['end_date'] ?></td>
                    <td><?= $booking['bid'] ?></td>
                    <td><?= $booking['building_type'] ?></td>
                    <td><?= $booking['booking_id'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </section>

    <script>
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.dashboard-section').forEach(function(section) {
                section.classList.remove('active');
            });

            // Show the selected section
            document.getElementById(sectionId).classList.add('active');
        }
    </script>
</body>
</html>