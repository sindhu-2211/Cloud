<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctor";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message variable
$message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $age = $_POST["age"];
    $sex = $_POST["sex"];
    $course = $_POST["course"];
    $specialization = $_POST["specialization"];
    $year = $_POST["year"];
    $tabletName = $_POST["tabletName"];
    $quantity = $_POST["quantity"];
    $amountPaid = $_POST["amountPaid"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO pati (name, age, sex, course, specialization, year, tabletName, quantity, amountPaid, date, time) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sississssss", $name, $age, $sex, $course, $specialization, $year, $tabletName, $quantity, $amountPaid, $date, $time);

    // Execute the statement
    if ($stmt->execute()) {
        $message = "Form submitted successfully!";
        echo "<script>alert('$message'); window.location.href='patient.html';</script>";
        exit; // Ensure that no further code is executed after redirection
    } else {
        $message = "Error: " . $stmt->error;
        echo "<script>alert('$message');</script>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
