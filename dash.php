<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['userid'])) {
    header("Location: check.php");
    exit();
}

// Fetch role and permissions
$role = $_SESSION['rolename'];
$permissions_query = "
    SELECT p.page_name, p.can_add, p.can_view, p.can_edit, p.can_delete, p.can_push, p.can_pull
    FROM role_permissions rp
    JOIN permissions p ON rp.permission_id = p.permissionid
    JOIN roles r ON rp.role_id = r.roleid
    WHERE r.rolename = ?";
$stmt = $conn->prepare($permissions_query);
$stmt->bind_param("s", $role);
$stmt->execute();
$result = $stmt->get_result();

$pages = [];
while ($row = $result->fetch_assoc()) {
    $pages[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<style>
.sidebar {
    width: 200px;
    float: left;
    background-color: #f4f4f4;
    padding: 20px;
}
.content {
    margin-left: 220px;
    padding: 20px;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}
th {
    background-color: #f2f2f2;
}
button {
    padding: 5px 10px;
    margin-right: 5px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.add { background-color: green; color: white; }
.view { background-color: blue; color: white; }
.edit { background-color: orange; color: white; }
.delete { background-color: red; color: white; }
.push { background-color: purple; color: white; }
.pull { background-color: teal; color: white; }
button.hidden {
    display: none;
}
</style>
</head>
<body>
<h1>Welcome, <?php echo $_SESSION['fullname']; ?></h1>

<div class="sidebar">
<h2>Pages</h2>
<ul>
<?php foreach ($pages as $page): ?>
<li><a href="<?php echo strtolower(str_replace(' ', '_', $page['page_name'])); ?>.php"><?php echo $page['page_name']; ?></a></li>
<?php endforeach; ?>
</ul>
<a href="logout.php">Logout</a>
</div>

<div class="content">
<h2>Your Permissions</h2>
<table>
<thead>
<tr>
<th>Page</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach ($pages as $page): ?>
<tr>
<td><?php echo $page['page_name']; ?></td>
<td>
    <button class="add <?php echo $page['can_add'] ? '' : 'hidden'; ?>">Add</button>
    <button class="view <?php echo $page['can_view'] ? '' : 'hidden'; ?>">View</button>
    <button class="edit <?php echo $page['can_edit'] ? '' : 'hidden'; ?>">Edit</button>
    <button class="delete <?php echo $page['can_delete'] ? '' : 'hidden'; ?>">Delete</button>
    <button class="push <?php echo $page['can_push'] ? '' : 'hidden'; ?>">Push</button>
    <button class="pull <?php echo $page['can_pull'] ? '' : 'hidden'; ?>">Pull</button>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</body>
</html>
