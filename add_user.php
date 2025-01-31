<?php
session_start();
require 'config/config.php';

// Redirect if not logged in
if (!isset($_SESSION['userid'])) {
    header("Location: signin.php");
    exit();
}

$userid = $_SESSION['userid'];
$email = $_SESSION['email'];

// Fetch permissions for add_user.php from permit table
$stmt = $conn->prepare("SELECT can_add FROM permit WHERE (userid = ? OR email = ?) AND links = 'add_user.php'");
if ($stmt === false) {
    die("Failed to prepare the statement: " . $conn->error);
}

$stmt->bind_param("ss", $userid, $email);
$stmt->execute();
$result = $stmt->get_result();

$canAdd = 0; // Default to no permission
if ($row = $result->fetch_assoc()) {
    $canAdd = $row['can_add'];
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $location = $_POST['location'];

    // Insert the new user into the database
    $insertStmt = $conn->prepare("INSERT INTO test_user (full_name, email, location) VALUES (?, ?, ?)");
    if ($insertStmt === false) {
        die("Failed to prepare the insert statement: " . $conn->error);
    }

    $insertStmt->bind_param("sss", $full_name, $email, $location);
    $insertSuccess = $insertStmt->execute();

    if ($insertSuccess) {
        // Update can_add to 0 in the permit table
        $updateStmt = $conn->prepare("UPDATE permit SET can_add = 0 WHERE (userid = ? OR email = ?) AND links = 'add_user.php'");
        if ($updateStmt === false) {
            die("Failed to prepare the update statement: " . $conn->error);
        }
        $updateStmt->bind_param("ss", $userid, $email);
        $updateStmt->execute();

        // Redirect to test2.php after successful insertion
        header("Location: test2.php");
        exit(); // Ensure no further code is executed after redirection
    } else {
        // Handle insertion failure
        die("Failed to insert user: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {},
            },
        };
    </script>
</head>
<body class="bg-gray-100">
    <div class="p-6">
        <h1 class="text-2xl font-bold">Add User</h1>

        <?php if ($canAdd == 1 || $canAdd == 2 || $canAdd == 3): ?>
            <!-- Display the form if can_add permission is granted -->
            <form action="add_user.php" method="POST" class="mt-4 space-y-4">
                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="full_name" id="full_name" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" id="location" required
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <?php if ($canAdd == 1): ?>
                        <!-- Active button -->
                        <button type="submit"
                                class="px-4 py-2 bg-green-500 hover:bg-green-700 text-white rounded">
                            Add User
                        </button>
                    <?php elseif ($canAdd == 2): ?>
                        <!-- Disabled button -->
                        <button type="submit"
                                class="px-4 py-2 bg-gray-500 text-white rounded cursor-not-allowed"
                                disabled>
                            Add User
                        </button>
                    <?php elseif ($canAdd == 3): ?>
                        <!-- Visible button after successful submission -->
                        <button type="submit"
                                class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded">
                            Add User (Submitted)
                        </button>
                    <?php endif; ?>
                </div>
            </form>
        <?php else: ?>
            <!-- Display a message if can_add permission is not granted -->
            <p class="mt-4 text-red-500">You do not have permission to add users.</p>
        <?php endif; ?>
    </div>
</body>
</html>