<?php
// Database connection settings
$host = 'localhost';         // Database server
$username = 'root';          // Database username
$password = '';              // Database password
$database = 'savings_db';  // Database name

// Establish the connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8
$conn->set_charset("utf8");

// Optional: Uncomment this for debugging successful connection
// echo "Connected successfully!";
?>
