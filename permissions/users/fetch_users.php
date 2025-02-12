<?php
require '../config/connection.php'; // Include Medoo connection

// Fetch users from `users_tbl`
$users = $database->select("users_tbl", [
    "fullname",
    "workid",
    "userid",
    "role",
    "status",
    "userimage"
]);

// Return JSON response
header('Content-Type: application/json');
echo json_encode($users);
?>
