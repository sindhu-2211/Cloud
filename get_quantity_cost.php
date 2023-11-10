<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CARE & CURE</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #menu {
            background-color: #e21c43;
            display: flex;
            justify-content: flex-end;
            padding: 20px;
        }

        .menu-link {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }

        .menu-link:hover {
            text-decoration: underline;
        }

        /* CSS for the dropdown */
        .dropdown-container {
            display: inline-block;
            position: relative;
        }

        .dropdown-container a {
            color: #333;
            text-decoration: none;
            padding: 10px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            min-width: 160px;
        }

        .dropdown-content a {
            display: block;
            padding: 10px;
        }

        .dropdown-container:hover .dropdown-content {
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .header-text {
            margin: 0;
            padding: 20px;
            color: #fff;
            font-size: 24px;
        }

        /* Style for "CARE & CURE" text */
        .care-cure {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #fff;
            font-size: 24px;
        }

        /* Style for the main content area */
        .content {
            padding: 20px;
            flex: 1;
        }

        /* Style for the footer */
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        /* Style for the tablet information */
        .tablet-info {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #e2e2e2;
            margin: 20px 0;
            max-width: 600px;
            margin: auto;
        }

        .tablet-info h2 {
            color: #e21c43;
        }

        /* Additional styles for form input fields */
        form {
            margin-top: 20px;
        }

        form input {
            margin-bottom: 10px;
            padding: 8px;
            width: 100%;
        }

        form input[type="submit"] {
            background-color: #e21c43;
            color: #fff;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #c1173d;
        }
    </style>
</head>

<body>
    <div id="menu">
        <div class="dropdown-container">
            <a href="#" title="Tablet Info">TABLET INFO</a>
            <div class="dropdown-content">
                <a href="fetch.php">Check/Modify</a>
                <a href="addTablet.html">Add Tablet</a>
            </div>
        </div>
        <div class="menu-link">
            <a href="patient.html" title="Patient Details">PATIENT DETAILS</a>
        </div>
        <div class="menu-link">
            <a href="logout.html" title="Logout">LOGOUT</a>
        </div>
    </div>

    <?php
    // Your PHP code here
    // Database connection parameters
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'doctor';

    // Create a database connection
    $connection = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    if (isset($_POST['get_quantity_cost'])) {
        $tabletname = $_POST['tabletname'];

        // Retrieve data for the selected tablet
        $sql = "SELECT cost, Quantity, DateOfExpiry FROM tablet3 WHERE tabletname = ?";
        $stmt = $connection->prepare($sql);

        // Check if the statement is prepared successfully
        if ($stmt === false) {
            die("Error preparing statement: " . $connection->error);
        }

        // Bind parameters
        $stmt->bind_param('s', $tabletname);

        // Execute the query
        if ($stmt->execute()) {
            $stmt->bind_result($cost, $quantity, $dateOfExpiry);
            $stmt->fetch();

            // Display the fetched data with styling
            echo "<div class='tablet-info'>";
            echo "<h2>Selected Tablet: " . $tabletname . "</h2>";
            echo "<p><b>Cost: " . $cost . "</b></p>";
            echo "<p><b>Quantity: " . $quantity . "</b></p>";
            echo "<p><b>Date of Expiry: " . $dateOfExpiry . "</b></p>";

            // Provide input fields for modifications with inline styles
            echo "<h2 style='color: #e21c43;'>Modify Data</h2>";
            echo "<form method='post' action='update.php'>";
            echo "<input type='hidden' name='tabletname' value='$tabletname'>";
            echo "<div><b>Cost: </b><input type='text' name='cost' value='$cost'></div>";
            echo "<div><b>Quantity:</b> <input type='text' name='quantity' value='$quantity'></div>";
            echo "<div><b>Date of Expiry:</b> <input type='text' name='dateOfExpiry' value='$dateOfExpiry'></div>";
            echo "<input type='submit' name='update_data' value='Update Data'>";
            echo "</form>";
            echo "</div>";
        } else {
            echo "Error retrieving data: " . $stmt->error;
        }
    }
    ?>

    <!-- Footer -->
    <footer>
        <p>&copy; 2023 CARE & CURE <br>
            All rights reserved <br>
            Team: Avula Jhansy, Oladri Renuka, Bodapatla Sindhu Priya, Bakka Shravya Reddy, Varanasi Vaishnavi, Mayur Jhadav</p>
    </footer>
</body>

</html>
