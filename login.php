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
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query to check the user's credentials against the "users" table in the "doctor" database
    $query = "SELECT * FROM signup WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Successful login
        $_SESSION["username"] = $username;
        header("Location: patient.html"); // Redirect to the new page
        exit();
    } else {
        // Invalid credentials
        echo "Wrong username or password. Please <a href='login.html'>sign up and login</a>.";
    }
}

mysqli_close($con);
?>

