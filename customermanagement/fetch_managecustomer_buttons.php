<?php
// Start session
session_start();

// Database connection settings
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'savings_db';

// Establish database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Ensure user is logged in
if (!isset($_SESSION['userid'])) {
    die(json_encode(["error" => "User not logged in"]));
}

$userid = $_SESSION['userid']; // Get session user ID

// Define button IDs
$buttons = [
    "add" => 14,
    "edit" => 11,
    "delete" => 12,
    "show" => 13
];

$buttonStates = []; // Store button states

foreach ($buttons as $key => $buttonId) {
    // Fetch button data based on ID
    $sql = "SELECT activeids, inactiveids FROM customerbuttons WHERE id = $buttonId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $button = $result->fetch_assoc();
        $activeIds = explode(',', $button['activeids']);
        $inactiveIds = explode(',', $button['inactiveids']);

        // Determine button state
        if (in_array($userid, $inactiveIds)) {
            $buttonStates[$key] = "disabled"; // User in inactive list
        } elseif (in_array($userid, $activeIds)) {
            $buttonStates[$key] = "enabled"; // User in active list
        } else {
            $buttonStates[$key] = "hidden"; // User not in active or inactive lists
        }
    } else {
        $buttonStates[$key] = "hidden"; // Default to hidden if button not found
    }
}

// Close database connection
$conn->close();

// Return JSON response
echo json_encode($buttonStates);
?>
