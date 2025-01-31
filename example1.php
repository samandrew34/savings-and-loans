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

// Modified query to account for the visibility columns
$stmt = $conn->prepare("
    SELECT menu_head, dropdown_item, hide_menu, hide_dropdown, visible_to_user_ids, visible_to_all, visible_to_one, show_to_specific_ids
    FROM permissions 
    WHERE role = ? AND hide_menu = 0
");
$stmt->bind_param("s", $role);
$stmt->execute();
$result = $stmt->get_result();

$menu = [];
while ($row = $result->fetch_assoc()) {
    // Extract visibility data
    $visible_to_user_ids = $row['visible_to_user_ids'] ? explode(',', $row['visible_to_user_ids']) : [];
    $show_to_specific_ids = $row['show_to_specific_ids'] ? explode(',', $row['show_to_specific_ids']) : [];
    $visible_to_all = $row['visible_to_all'];
    $visible_to_one = $row['visible_to_one'];

    // Determine visibility
    $is_visible = true;

    // If visible_to_all is 1, the menu is hidden from all users
    if ($visible_to_all == 1) {
        $is_visible = false;
    }

    // If visible_to_one is 0, hide the menu for this specific user
    if ($visible_to_one == 0 && in_array($userid, $visible_to_user_ids)) {
        $is_visible = false;
    }

    // Check if the user is in the `show_to_specific_ids` list
    if (!empty($show_to_specific_ids) && !in_array($userid, $show_to_specific_ids)) {
        $is_visible = false;
    }

    // If the menu is still visible, add it to the $menu array
    if ($is_visible) {
        if (!isset($menu[$row['menu_head']])) {
            $menu[$row['menu_head']] = [];
        }
        if ($row['hide_dropdown'] == 0) {
            $menu[$row['menu_head']][] = $row['dropdown_item'];
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
                  <li class="text-sm px-4 py-1 hover:bg-gray-600"><?= htmlspecialchars($item); ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
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
