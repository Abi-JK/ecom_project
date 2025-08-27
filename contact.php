<?php
// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection settings
$host = "localhost";
$username = "root";               // Update if using a different DB user
$password = "your_mysql_password"; // Replace with your actual MySQL password
$database = "ecommerce";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("<h2 style='color: red;'>Connection failed: " . $conn->connect_error . "</h2>");
}

// Check if POST data is set
if (isset($_POST['name'], $_POST['email'], $_POST['message'])) {
    // Get and sanitize POST data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate basic input
    if (empty($name) || empty($email) || empty($message)) {
        echo "<h2 style='color: red;'>All fields are required. Please fill out the form completely.</h2>";
    } else {
        // Prepare and execute SQL statement
        $sql = "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $name, $email, $message);

            if ($stmt->execute()) {
                echo "<h2 style='color: green; font-family: Arial;'>Thank you! Your message has been sent successfully.</h2>";
                echo "<p><a href='index.html'>Return to Home</a></p>";
            } else {
                echo "<h2 style='color: red;'>Oops! Something went wrong while saving your message.</h2>";
            }

            $stmt->close();
        } else {
            echo "<h2 style='color: red;'>Failed to prepare the SQL statement. Please check your database structure.</h2>";
        }
    }
} else {
    echo "<h2 style='color: red;'>Form data not received. Please submit the form properly.</h2>";
}

// Close the connection
$conn->close();
?>