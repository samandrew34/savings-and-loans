<?php
require 'config/connection.php';
session_start();

// Get the logged-in user's ID
$loggedInUserId = $_SESSION['userid'] ?? null;

$users = $database->select("users_tbl", [
    "[>]usersbuttons" => ["userid" => "userid"]
], [
    "users_tbl.userid",
    "users_tbl.fullname",
    "users_tbl.workid",
    "users_tbl.role",
    "users_tbl.userimage",
    "users_tbl.status",
    "usersbuttons.buttonnames",
    "usersbuttons.activeids",
    "usersbuttons.inactiveids"
], [
    "users_tbl.role[!]" => "super_administrator", // Exclude super admins
    "users_tbl.userid[!]" => $loggedInUserId      // Exclude logged-in user
]);

// Remove duplicates by using an associative array
$uniqueUsers = [];
foreach ($users as $user) {
    $userId = $user['userid'];
    
    if (!isset($uniqueUsers[$userId])) {
        $activeIds = explode(",", $user['activeids'] ?? '');
        $inactiveIds = explode(",", $user['inactiveids'] ?? '');

        // Trim whitespace
        $activeIds = array_map('trim', $activeIds);
        $inactiveIds = array_map('trim', $inactiveIds);

        // Ensure buttons are only shown if the user is NOT inactive
        $user['show_buttons'] = !in_array($loggedInUserId, $inactiveIds);
        $user['specific_buttons'] = in_array($loggedInUserId, $activeIds);

        $uniqueUsers[$userId] = $user;
    }
}

header('Content-Type: application/json');
echo json_encode(array_values($uniqueUsers)); // Return unique users
?>
