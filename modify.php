<?php
if (isset($_POST['update_info'])) {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'doctor';

    // Create a database connection
    $connection = new mysqli($host, $username, $password, $database);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    $tabletname = $_POST['tabletname'];
    $cost = $_POST['cost'];
    $quantity = $_POST['quantity'];
    $dateOfExpiry = $_POST['dateOfExpiry'];

    // Prepare and execute an SQL statement to update the tablet information
    $sql = "UPDATE tablet3 SET cost=?, Quantity=?, DateOfExpiry=? WHERE tabletname=?";
    $stmt = $connection->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $connection->error);
    }

    $stmt->bind_param('diss', $cost, $quantity, $dateOfExpiry, $tabletname);

    if ($stmt->execute()) {
        echo "Tablet information updated successfully.";
    } else {
        echo "Error updating tablet information: " . $stmt->error;
    }

    $connection->close();
}
?>
