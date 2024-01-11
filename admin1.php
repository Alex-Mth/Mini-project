<?php
include('config.php');

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}

function updateUser($conn, $userId, $columnName, $newValue) {
    $conn->begin_transaction();

    try {
        $updateRelatedQuery = "UPDATE booking SET username = ? WHERE username = ?";
        $stmtRelated = $conn->prepare($updateRelatedQuery);
        $stmtRelated->bind_param("ss", $newValue, $userId);
        $stmtRelated->execute();
        $stmtRelated->close();

        $updateQuery = "UPDATE user SET $columnName = ? WHERE userid = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("si", $newValue, $userId);
        $stmt->execute();
        $stmt->close();

        $conn->commit();
    } catch (mysqli_sql_exception $e) {
        $conn->rollback();
        throw $e;
    }
}

function updateProperty($conn, $propertyId, $columnName, $newValue) {
    $checkQuery = "SELECT COUNT(*) FROM building WHERE bid = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("i", $newValue);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        throw new Exception("Error: The new bid value already exists.");
    }

    $updateQuery = "UPDATE building SET $columnName = ? WHERE bid = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ii", $newValue, $propertyId);
    $stmt->execute();
    $stmt->close();
}

function updateBooking($conn, $bookingId, $columnName, $newValue) {
    $updateQuery = "UPDATE booking SET $columnName = ? WHERE booking_id = ?";
    $stmt = $conn->prepare($updateQuery);

    if ($columnName == 'username') {
        $updateRelatedQuery = "UPDATE booking SET username = ? WHERE username = ?";
        $stmtRelated = $conn->prepare($updateRelatedQuery);
        $stmtRelated->bind_param("ss", $newValue, $bookingId);
        $stmtRelated->execute();
        $stmtRelated->close();
    }

    $stmt->bind_param("si", $newValue, $bookingId);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editSubmit'])) {
        $section = sanitizeInput($_POST['section']);
        $column = sanitizeInput($_POST['column']);
        $id = sanitizeInput($_POST['id']);
        $newValue = sanitizeInput($_POST['newValue']);

        try {
            switch ($section) {
                case 'userAccounts':
                    updateUser($conn, $id, $column, $newValue);
                    break;
                case 'propertyDetails':
                    updateProperty($conn, $id, $column, $newValue);
                    break;
                case 'bookingDetails':
                    updateBooking($conn, $id, $column, $newValue);
                    break;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
<!-- rest of the HTML and JavaScript code remains unchanged -->
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

        .edit-button {
            background-color: #008CBA;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
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
                <th>Edit</th>
                <th>User ID</th>
                <th>Username</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Password</th>
                <th>Address</th>
            </tr>
            <?php
            $userQuery = "SELECT * FROM user";
            $userResult = $conn->query($userQuery);
            while ($user = $userResult->fetch_assoc()):
            ?>
                <tr>
                    <td>
                        <button class="edit-button" onclick="showEditForm('userAccounts', '<?= $user['userid'] ?>')">Edit</button>
                    </td>
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
                <th>Edit</th>
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
            <?php
            $propertyQuery = "SELECT * FROM building";
            $propertyResult = $conn->query($propertyQuery);
            while ($property = $propertyResult->fetch_assoc()):
            ?>
                <tr>
                    <td>
                        <button class="edit-button" onclick="showEditForm('propertyDetails', '<?= $property['bid'] ?>')">Edit</button>
                    </td>
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
                <th>Edit</th>
                <th>Username</th>
                <th>Booking Date</th>
                <th>Token Amount</th>
                <th>End Date</th>
                <th>Property ID</th>
                <th>Building Type</th>
                <th>Booking ID</th>
            </tr>
            <?php
            $bookingQuery = "SELECT * from booking";
            $bookingResult = $conn->query($bookingQuery);
            while ($booking = $bookingResult->fetch_assoc()):
            ?>
                <tr>
                    <td>
                        <button class="edit-button" onclick="showEditForm('bookingDetails', '<?= $booking['booking_id'] ?>')">Edit</button>
                    </td>
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

    <!-- Edit Forms -->
    <div id="userAccountsEditForm" class="dashboard-section" style="display: none;">
        <h2>Edit User Account</h2>
        <form method="post" action="">
            <input type="hidden" name="section" value="userAccounts">
            <label for="userAccountsColumn">Select Column to Edit:</label>
            <select name="column" id="userAccountsColumn">
                <?php
                $userColumns = ['userid', 'username', 'name', 'phone', 'email', 'password', 'address'];
                foreach ($userColumns as $column):
                ?>
                    <option value="<?= $column ?>"><?= $column ?></option>
                <?php endforeach; ?>
            </select>
            <label for="userAccountsId">Enter User ID:</label>
            <input type="text" name="id" id="userAccountsId" required>
            <label for="userAccountsNewValue">Enter New Value:</label>
            <input type="text" name="newValue" id="userAccountsNewValue" required>
            <button type="submit" name="editSubmit">Edit</button>
        </form>
    </div>

    <div id="propertyDetailsEditForm" class="dashboard-section" style="display: none;">
        <h2>Edit Property Details</h2>
        <form method="post" action="">
            <input type="hidden" name="section" value="propertyDetails">
            <label for="propertyDetailsColumn">Select Column to Edit:</label>
            <select name="column" id="propertyDetailsColumn">
                <?php
                $propertyColumns = ['bid', 'areainsqft', 'description', 'bedrooms', 'bathrooms', 'floor', 'roof', 'age', 'condition', 'building_type', 'price', 'address'];
                foreach ($propertyColumns as $column):
                ?>
                    <option value="<?= $column ?>"><?= $column ?></option>
                <?php endforeach; ?>
            </select>
            <label for="propertyDetailsId">Enter Property ID:</label>
            <input type="text" name="id" id="propertyDetailsId" required>
            <label for="propertyDetailsNewValue">Enter New Value:</label>
            <input type="text" name="newValue" id="propertyDetailsNewValue" required>
            <button type="submit" name="editSubmit">Edit</button>
        </form>
    </div>

    <div id="bookingDetailsEditForm" class="dashboard-section" style="display: none;">
        <h2>Edit Booking Details</h2>
        <form method="post" action="">
            <input type="hidden" name="section" value="bookingDetails">
            <label for="bookingDetailsColumn">Select Column to Edit:</label>
            <select name="column" id="bookingDetailsColumn">
                <?php
                $bookingColumns = ['username', 'booking_date', 'token_amount', 'end_date', 'bid', 'building_type', 'booking_id'];
                foreach ($bookingColumns as $column):
                ?>
    <option value="<?= $column ?>"><?= $column ?></option>
                <?php endforeach; ?>
            </select>
            <label for="bookingDetailsId">Enter Booking ID:</label>
            <input type="text" name="id" id="bookingDetailsId" required>
            <label for="bookingDetailsNewValue">Enter New Value:</label>
            <input type="text" name="newValue" id="bookingDetailsNewValue" required>
            <button type="submit" name="editSubmit">Edit</button>
        </form>
    </div>

    <script>
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.dashboard-section').forEach(function(section) {
                section.classList.remove('active');
            });

            // Show the selected section
            document.getElementById(sectionId).classList.add('active');
        }

        function showEditForm(section, id) {
            // Hide all edit forms
            document.querySelectorAll('.dashboard-section').forEach(function(editForm) {
                editForm.style.display = 'none';
            });
                       // Show the edit form for the selected section and ID
                       document.getElementById(section + 'EditForm').style.display = 'block';
                       document.getElementById(section + 'Id').value = id;
        }
    </script>
</body>

</html>