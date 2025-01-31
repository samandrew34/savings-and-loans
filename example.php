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

// Modified query to include the `links` column
$stmt = $conn->prepare("
    SELECT menu_head, dropdown_item, links, hide_menu, hide_dropdown, visible_to_user_ids, visible_to_all, visible_to_one, show_to_specific_ids
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

    if ($visible_to_all == 1) {
        $is_visible = false;
    }
    if ($visible_to_one == 0 && in_array($userid, $visible_to_user_ids)) {
        $is_visible = false;
    }
    if (!empty($show_to_specific_ids) && !in_array($userid, $show_to_specific_ids)) {
        $is_visible = false;
    }

    // Add to the menu if visible
    if ($is_visible) {
        if (!isset($menu[$row['menu_head']])) {
            $menu[$row['menu_head']] = [];
        }
        if ($row['hide_dropdown'] == 0) {
            $menu[$row['menu_head']][] = [
                'name' => $row['dropdown_item'],
                'link' => $row['links']
            ];
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-dark text-white vh-100" style="width: 250px;">
      <div class="p-4 text-center">
        <h2 class="h4">Welcome</h2>
        <p><?= htmlspecialchars($_SESSION['fullname']); ?></p>
        <p class="text-muted"><?= htmlspecialchars($_SESSION['email']); ?></p>
        <p class="text-muted"><?= htmlspecialchars($_SESSION['role']); ?></p>
      </div>
      <ul class="nav flex-column">
        <?php foreach ($menu as $menu_head => $dropdown_items): ?>
          <li class="nav-item">
            <div class="bg-secondary text-white py-2 px-3"><?= htmlspecialchars($menu_head); ?></div>
            <?php if (!empty($dropdown_items)): ?>
              <ul class="list-unstyled ms-3 mt-2">
                <?php foreach ($dropdown_items as $item): ?>
                  <li class="py-1">
                    <a href="#" class="text-decoration-none text-light"><?= htmlspecialchars($item); ?></a>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
      <!-- Logout Button -->
      <div class="mt-4 p-3">
        <form action="signout.php" method="POST">
          <button type="submit" class="btn btn-danger w-100">
            Logout
          </button>
        </form>
      </div>
    </div>
    <!-- Main Content -->
    <div class="flex-grow-1 p-4">
      <h1 class="h3">Dashboard</h1>
      <p>Welcome to your dashboard! Use the menu to navigate.</p>
    </div>
  </div>

  <div class="p-4 text-center">
    <h2 class="h4">Welcome</h2>
    <p><?= htmlspecialchars($_SESSION['fullname']); ?></p>
    <p class="text-muted">Email: <?= htmlspecialchars($_SESSION['email']); ?></p>
    <p class="text-muted">Username: <?= htmlspecialchars($_SESSION['username']); ?></p>
    <p class="text-muted">Role: <?= htmlspecialchars($_SESSION['role']); ?></p>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
