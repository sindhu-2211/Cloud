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

if (isset($_POST['update_data'])) {
    $tabletname = $_POST['tabletname'];
    $cost = $_POST['cost'];
    $quantity = $_POST['quantity'];
    $dateOfExpiry = $_POST['dateOfExpiry'];

    // Prepare the SQL statement to update the data for the selected tablet
    $sql = "UPDATE tablet3 SET cost = ?, Quantity = ?, DateOfExpiry = ? WHERE tabletname = ?";
    $stmt = $connection->prepare($sql);

    // Check if the statement is prepared successfully
    if ($stmt === false) {
        die("Error preparing statement: " . $connection->error);
    }

    // Bind parameters
    $stmt->bind_param('diss', $cost, $quantity, $dateOfExpiry, $tabletname);

    // Execute the query to update the data
    if ($stmt->execute()) {
        // Use JavaScript to show an alert and redirect to the welcome page
        echo "<script>
            alert('Data updated successfully for tablet: $tabletname');
            window.location.href = 'welcome.html'; // Replace 'welcome.php' with the actual welcome page URL
        </script>";
    } else {
        // Use JavaScript to show an alert for the error
        echo "<script>alert('Error updating data: " . $stmt->error . "');</script>";
    }
}
?>
