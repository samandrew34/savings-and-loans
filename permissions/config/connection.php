<?php
require 'medoo/src/Medoo.php'; // Ensure Medoo is included correctly

use Medoo\Medoo;

// Database connection using Medoo
$database = new Medoo([
    'type' => 'mysql',
    'host' => 'localhost',
    'database' => 'savings_db',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4'
]);

try {
    $database->query("SELECT 1"); // Check if database is reachable
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
