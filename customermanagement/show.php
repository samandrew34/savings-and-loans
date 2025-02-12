<?php
// Start the session
session_start();

// Database connection settings
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'savings_db';

// Establish the connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8
$conn->set_charset("utf8");

// Ensure the user is logged in and get the session user ID
if (!isset($_SESSION['userid'])) {
    die('<p class="text-danger">User not logged in</p>');
}

$userid = $_SESSION['userid']; // Get logged-in user ID from session

// Fetch the button data for "Add" where id = 1
$sql = "SELECT * FROM customerbuttons WHERE id = 1";
$result = $conn->query($sql);

$showButton = false; // Default: Don't show the button

if ($result->num_rows > 0) {
    $button = $result->fetch_assoc();
    $buttonStatus = $button['buttonstatus'];
    $activeIds = explode(',', $button['activeids']);  // Convert active IDs to an array
    $inactiveIds = explode(',', $button['inactiveids']); // Convert inactive IDs to an array

    // Check if the button should be displayed
    if (
        $buttonStatus == 1 && // Button must be active
        in_array($userid, $activeIds) && // User must be in activeIds
        !in_array($userid, $inactiveIds) // User must NOT be in inactiveIds
    ) {
        $showButton = true; // Allow button display
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Button Visibility</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
    <div class="container mt-5">
        <?php if ($showButton): ?>
            <button type="button" class="btn btn-sm btn-square btn-neutral text-success-hover ms-auto">
                <i class="bi bi-plus-circle"></i> Add
            </button>
        <?php else: ?>
            <p class="text-danger">Not Permitted</p>
        <?php endif; ?>
    </div>
</body>
</html>
