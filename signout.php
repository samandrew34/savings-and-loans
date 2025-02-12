<?php
session_start();
require 'config/connection.php'; // Ensure Medoo connection is properly set up

if (isset($_SESSION['userid']) && isset($_SESSION['fullname'])) {
    $userid = $_SESSION['userid'];
    $username = $_SESSION['fullname']; // Assuming fullname is stored as the username

    // Update user status to inactive
    $database->update("users_tbl", ["status" => "inactive"], ["userid" => $userid]);

    // Update logout time in logs table
    $database->update("logs", [
        "logouttime" => date("Y-m-d H:i:s")
    ], [
        "username" => $username,
        "logouttime" => null // Ensure we update only the last active session
    ]);

    // Destroy session securely
    session_unset();
    session_destroy();
    session_write_close();
    session_regenerate_id(true);
}

// Redirect to login page
header("Location: index.php");
exit();
