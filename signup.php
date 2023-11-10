<?php
session_start();

$server = "localhost";
$username = "root";
$password = "";
$database = "doctor";

// Create a connection to the MySQL server
$con = mysqli_connect($server, $username, $password, $database);

if (!$con) {
    die("Connection failed due to " . mysqli_connect_error());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["signupUsername"];
    $email = $_POST["email"];
    $password = $_POST["signupPassword"];

    // You should also perform input validation and sanitation here to prevent SQL injection

    // Query to insert the user's data into the "user" table
    $query = "INSERT INTO signup (username, email, password) VALUES ('$username', '$email', '$password')";

    if (mysqli_query($con, $query)) {
        // Registration successful, redirect to the login page
        header("Location: login.html");
        exit();
    } else {
        echo "Error registering user: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>