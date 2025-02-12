<?php
require 'medoo/src/Medoo.php'; // Adjust the path if necessary

use Medoo\Medoo;

// Database connection
$database = new Medoo([
    'type' => 'mysql',      // Database type (e.g., mysql, sqlite, pgsql)
    'host' => 'localhost',  // Your database host
    'database' => 'savings_db', // Your database name
    'username' => 'root', // Your database username
    'password' => '', // Your database password
    'charset' => 'utf8mb4'  // Character encoding
]);

// Check connection
try {
    $database->query("SELECT 1"); // Simple query to check connection
    // echo "Database connected successfully!";
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
