

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
    FROM permit 
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
    if (!empty($show_to_specific_ids) && !in_array($userid, $show_to_specific_ids)) {
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