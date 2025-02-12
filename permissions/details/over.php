<?php
// Include the database connection
include 'config/config.php';

// Fetch total users
$totalUsersQuery = "SELECT COUNT(*) AS total FROM users_tbl";
$totalUsersResult = $conn->query($totalUsersQuery);
$totalUsers = $totalUsersResult->fetch_assoc()['total'];

// Fetch active users
$activeUsersQuery = "SELECT COUNT(*) AS active FROM users_tbl WHERE status = 'active'";
$activeUsersResult = $conn->query($activeUsersQuery);
$activeUsers = $activeUsersResult->fetch_assoc()['active'];

// Fetch inactive users
$inactiveUsersQuery = "SELECT COUNT(*) AS inactive FROM users_tbl WHERE status = 'inactive'";
$inactiveUsersResult = $conn->query($inactiveUsersQuery);
$inactiveUsers = $inactiveUsersResult->fetch_assoc()['inactive'];

// Fetch blocked users
$blockedUsersQuery = "SELECT COUNT(*) AS blocked FROM users_tbl WHERE account = 0";
$blockedUsersResult = $conn->query($blockedUsersQuery);
$blockedUsers = $blockedUsersResult->fetch_assoc()['blocked'];

?>

<div class="row g-6 mb-6">
    <!-- Total Users -->
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total Users</span>
                        <span class="h3 font-bold mb-0"><?= $totalUsers; ?></span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Users -->
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Active Users</span>
                        <span class="h3 font-bold mb-0"><?= $activeUsers; ?></span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-success text-white text-lg rounded-circle">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inactive Users -->
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Inactive Users</span>
                        <span class="h3 font-bold mb-0"><?= $inactiveUsers; ?></span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-warning text-white text-lg rounded-circle">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blocked Users -->
    <div class="col-xl-3 col-sm-6 col-12">
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="h6 font-semibold text-muted text-sm d-block mb-2">Blocked Users</span>
                        <span class="h3 font-bold mb-0"><?= $blockedUsers; ?></span>
                    </div>
                    <div class="col-auto">
                        <div class="icon icon-shape bg-danger text-white text-lg rounded-circle">
                            <i class="bi bi-x-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
