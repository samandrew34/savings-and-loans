<?php
require '../config/connection.php'; // Ensure database connection

if (!isset($_GET['userid']) || !isset($_GET['role'])) {
    die("Invalid request. User ID and role are required.");
}

$userid = $_GET['userid'];
$role = $_GET['role'];

// Fetch user permissions by joining `users_tbl` and `permit`
$permissions = $database->select("permit", [
    "[>]users_tbl" => ["userid" => "userid"]
], [
    "users_tbl.fullname",
    "users_tbl.role",
    "permit.menu_head",
    "permit.dropdown_item",
    "permit.links"
], [
    "users_tbl.userid" => $userid,
    "users_tbl.role" => $role
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Permissions</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">User Permissions</h3>
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-4 py-2">Full Name</th>
                        <th class="border px-4 py-2">Role</th>
                        <th class="border px-4 py-2">Menu Head</th>
                        <th class="border px-4 py-2">Dropdown Item</th>
                        <th class="border px-4 py-2">Link</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($permissions)): ?>
                        <?php foreach ($permissions as $permission): ?>
                            <tr class="hover:bg-gray-100">
                                <td class="border px-4 py-2 text-center"><?= htmlspecialchars($permission['fullname']) ?></td>
                                <td class="border px-4 py-2 text-center"><?= htmlspecialchars($permission['role']) ?></td>
                                <td class="border px-4 py-2 text-center"><?= htmlspecialchars($permission['menu_head']) ?></td>
                                <td class="border px-4 py-2 text-center"><?= htmlspecialchars($permission['dropdown_item']) ?></td>
                                <td class="border px-4 py-2 text-center">
                                    <a href="<?= htmlspecialchars($permission['links']) ?>" target="_blank" class="text-blue-500 hover:text-blue-700">Visit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center border px-4 py-2">No permissions found for this user.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Back Button -->
    <div class="max-w-4xl mx-auto mt-4">
        <a href="manage_permissions.php" class="block text-center bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-900 transition">
            Back
        </a>
    </div>
</body>
</html>
