<?php
session_start();
require 'connection.php';

// Redirect if not logged in
if (!isset($_SESSION['userid'])) {
    header("Location: logg.php");
    exit();
}

// Fetch permissions for the logged-in user by joining users and permissions tables
$userid = $_SESSION['userid'];
$stmt = $conn->prepare("
    SELECT p.menu_head, p.dropdown_item, p.hide_menu, p.hide_dropdown 
    FROM permissions p
    INNER JOIN users u ON u.role = p.role
    WHERE u.userid = ? AND p.hide_menu = 0
");
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

$menu = [];
while ($row = $result->fetch_assoc()) {
    if (!isset($menu[$row['menu_head']])) {
        $menu[$row['menu_head']] = [];
    }
    if ($row['hide_dropdown'] == 0) {
        $menu[$row['menu_head']][] = $row['dropdown_item'];
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
        <h2 class="text-lg font-bold">Welcome, <?= htmlspecialchars($_SESSION['fullname']); ?></h2>
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
    </div>
    <!-- Main Content -->
    <div class="flex-grow p-6">
      <h1 class="text-2xl font-bold">Dashboard</h1>
      <p>Select a menu item to get started.</p>
    </div>
  </div>
</body>
</html>
