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

// Retrieve tablet names from the database
$query = "SELECT tabletname FROM tablet3";
$result = $connection->query($query);

// Check if the query was successful
if (!$result) {
    die("Error executing the query: " . $connection->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tablet Quantity and Cost</title>
    <link rel="stylesheet" type="text/css" href="fetch.css">
    <link rel="stylesheet" type="text/css" href="header.css">
</head>
<body>
    <!-- Include the header -->
    <?php include 'header.html'; ?>

    <h1>Select a Tablet</h1>
    <form method="post" action="get_quantity_cost.php">
        <select name="tabletname">
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['tabletname'] . "'>" . $row['tabletname'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" name="get_quantity_cost" value="Get Details ">
    </form>

    <!-- Include the footer -->
    <?php include 'footer.html'; ?>
</body>
</html>
