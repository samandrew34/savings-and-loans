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

// Fetch permissions from permit table
$stmt = $conn->prepare("SELECT links, can_view, can_add, can_edit, can_delete FROM permit WHERE userid = ? OR email = ?");
if ($stmt === false) {
    die("Failed to prepare the statement: " . $conn->error);
}

$stmt->bind_param("ss", $userid, $email);
$stmt->execute();
$result = $stmt->get_result();

$permissions = [];
while ($row = $result->fetch_assoc()) {
    $permissions[$row['links']] = [
        'can_view' => $row['can_view'],
        'can_add' => $row['can_add'],
        'can_edit' => $row['can_edit'],
        'can_delete' => $row['can_delete']
    ];
}

// Get current page name (for example, 'dashboard.php')
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <p>Welcome to your dashboard! Use the menu to navigate.</p>

        <div class="mt-4 space-y-4">
            <?php foreach ($permissions as $links => $perm): ?>
                <?php
                // Only show the buttons for the current page (example: dashboard.php)
                if ($current_page !== basename($links)) {
                    continue;  // Skip if the link is not for the current page
                }
                ?>
                <div class="p-4 bg-white shadow-md rounded-lg">
                    <h2 class="font-semibold text-lg">Page: <?= htmlspecialchars($links); ?></h2>

                    <div class="mt-2 space-x-2">
                        <!-- View Button -->
                        <a href="<?= htmlspecialchars($links); ?>" 
                            class="px-4 py-2 rounded inline-block 
                            <?= $perm['can_view'] == 1 ? 'bg-blue-500 hover:bg-blue-700 text-white' : ($perm['can_view'] == 2 ? 'hidden' : 'bg-gray-300 cursor-not-allowed text-gray-500'); ?>">
                            View
                        </a>

                        <!-- Add Button -->
                        <button <?= $perm['can_add'] == 1 ? '' : 'disabled'; ?>
                            class="px-4 py-2 rounded 
                            <?= $perm['can_add'] == 1 ? 'bg-green-500 hover:bg-green-700 text-white' : ($perm['can_add'] == 2 ? 'hidden' : 'bg-gray-300 cursor-not-allowed text-gray-500'); ?>">
                            Add
                        </button>

                        <!-- Edit Button -->
                        <button <?= $perm['can_edit'] == 1 ? '' : 'disabled'; ?>
                            class="px-4 py-2 rounded 
                            <?= $perm['can_edit'] == 1 ? 'bg-yellow-500 hover:bg-yellow-700 text-white' : ($perm['can_edit'] == 2 ? 'hidden' : 'bg-gray-300 cursor-not-allowed text-gray-500'); ?>">
                            Edit
                        </button>

                        <!-- Delete Button -->
                        <button <?= $perm['can_delete'] == 1 ? '' : 'disabled'; ?>
                            class="px-4 py-2 rounded 
                            <?= $perm['can_delete'] == 1 ? 'bg-red-500 hover:bg-red-700 text-white' : ($perm['can_delete'] == 2 ? 'hidden' : 'bg-gray-300 cursor-not-allowed text-gray-500'); ?>">
                            Delete
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
