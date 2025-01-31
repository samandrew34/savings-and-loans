<?php
session_start();
require 'config/config.php';

// Redirect if not logged in
if (!isset($_SESSION['userid'])) {
    header("Location: signin.php");
    exit();
}

// Fetch permissions for the logged-in user
$userid = $_SESSION['userid'];
$role = $_SESSION['role'];

// Check if role is valid
if (empty($role)) {
    die("Role is not set correctly.");
}

// Modified query to account for the visibility columns
$stmt = $conn->prepare("
    SELECT menu_head, dropdown_item, hide_menu, hide_dropdown, visible_to_user_ids, visible_to_all, visible_to_one, show_to_specific_ids, links
    FROM permissionss 
    WHERE role = ? AND hide_menu = 0
");

if ($stmt === false) {
    die("Failed to prepare the statement: " . $conn->error);
}

$stmt->bind_param("s", $role);
$stmt->execute();
$result = $stmt->get_result();

// Initialize menu array
$menu = [];
while ($row = $result->fetch_assoc()) {
    // Extract visibility data
    $visible_to_user_ids = $row['visible_to_user_ids'] ? explode(',', $row['visible_to_user_ids']) : [];
    $show_to_specific_ids = $row['show_to_specific_ids'] ? explode(',', $row['show_to_specific_ids']) : [];
    $visible_to_all = $row['visible_to_all'];
    $visible_to_one = $row['visible_to_one'];
    $links = $row['links']; // Get the link from the database

    // Determine visibility
    $is_visible = true;

    // If visible_to_all is 1, hide the menu from all users
    if ($visible_to_all == 1) {
        $is_visible = false;
    }

    // If visible_to_one is 0, hide the menu for this specific user
    if ($visible_to_one == 0 && in_array($userid, $visible_to_user_ids)) {
        $is_visible = false;
    }

    // Check if the user is in the `show_to_specific_ids` list
    if (!empty($show_to_specific_ids) && in_array($userid, $show_to_specific_ids)) {
        // If the user is in `show_to_specific_ids`, make the menu item visible
        $is_visible = true;
    }

    // Check if the user is in the `visible_to_user_ids` list (and if they are not in `show_to_specific_ids`)
    if (!empty($visible_to_user_ids) && in_array($userid, $visible_to_user_ids) && !in_array($userid, $show_to_specific_ids)) {
        // If the user is in `visible_to_user_ids` but not in `show_to_specific_ids`, hide the menu
        $is_visible = false;
    }

    // If the menu is still visible, add it to the $menu array
    if ($is_visible) {
        if (!isset($menu[$row['menu_head']])) {
            $menu[$row['menu_head']] = [];
        }
        if ($row['hide_dropdown'] == 0) {
            // Add the link along with the item name
            $menu[$row['menu_head']][] = ['item' => $row['dropdown_item'], 'links' => $links];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <div class="min-h-screen flex">
    <!-- Sidebar -->
    <div class="w-64 bg-gray-800 text-white">
      <div class="p-4 text-center">
        <h2 class="text-lg font-bold">Welcome</h2>
        <p><?= htmlspecialchars($_SESSION['fullname']); ?></p>
        <p class="text-sm"><?= htmlspecialchars($_SESSION['email']); ?></p>
        <p class="text-sm"><?= htmlspecialchars($_SESSION['role']); ?></p>
      </div>
      <ul class="mt-4">
        <?php foreach ($menu as $menu_head => $dropdown_items): ?>
          <li class="mb-2">
            <div class="px-4 py-2 bg-gray-700 font-semibold"><?= htmlspecialchars($menu_head); ?></div>
            <?php if (!empty($dropdown_items)): ?>
              <ul class="ml-4 mt-2">
                <?php foreach ($dropdown_items as $item): ?>
                  <li class="text-sm px-4 py-1 hover:bg-gray-600">
                    <a href="<?= htmlspecialchars($item['links']); ?>" class="block"><?= htmlspecialchars($item['item']); ?></a>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
      <!-- Buttons -->
   
      <!-- Logout Button -->
      <div class="mt-4">
        <form action="signout.php" method="POST">
          <button type="submit" class="w-full px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded">
            Logout
          </button>
        </form>
      </div>
    </div>
    <!-- Main Content -->
    <div class="flex-grow p-6">
      <h1 class="text-2xl font-bold">Dashboard</h1>
      <p>Welcome to your dashboard! Use the menu to navigate.</p>
    </div>
  </div>
</body>
</html>
