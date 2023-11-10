<?php
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

if (isset($_POST['add_tablet'])) {
    $tabletname = $_POST['tabletname'];
    $cost = $_POST['cost'];
    $quantity = $_POST['quantity'];
    $dateOfExpiry = $_POST['dateOfExpiry'];

    // Prepare the SQL statement to insert data into the tablet3 table
    $sql = "INSERT INTO tablet3 (tabletname, cost, Quantity, DateOfExpiry) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);

    // Check if the statement is prepared successfully
    if ($stmt === false) {
        die("Error preparing statement: " . $connection->error);
    }

    // Bind parameters
    $stmt->bind_param('ssss', $tabletname, $cost, $quantity, $dateOfExpiry);

    // Execute the query to insert data
    if ($stmt->execute()) {
        // Tablet added successfully, use JavaScript to display an alert and redirect to the same page
        echo '<script>alert("Tablet added successfully!"); window.location.href = "index.html";</script>';
    } else {
        echo "Error adding tablet: " . $stmt->error;
    }
}
?>
