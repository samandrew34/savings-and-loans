<?php
require 'config/connection.php'; // Ensure database connection

// Check if `customerid` is provided
if (isset($_GET['customerid'])) {
    $customerid = $_GET['customerid'];

    // Fetch customer data
    $customer = $database->get("customerdata", "*", ["customerid" => $customerid]);

    if ($customer) {
        echo json_encode($customer);
    } else {
        echo json_encode(["error" => "Customer not found"]);
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}
?>
