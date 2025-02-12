<?php
require 'config/connection.php'; // Ensure database connection

header('Content-Type: application/json');

try {
    $customers = $database->select("customerdata", [
        "fullname",
        "customerid",
        "customernumber",
        "email",
        "location",
        "customerimage"
    ]);

    echo json_encode($customers);
} catch (Exception $e) {
    echo json_encode(["error" => "Database query failed: " . $e->getMessage()]);
}
?>


