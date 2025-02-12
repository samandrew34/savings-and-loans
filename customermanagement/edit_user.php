<?php
session_start();
require 'config/connection.php'; // Ensure database connection

// Redirect if not logged in
if (!isset($_SESSION['userid'])) {
    header("Location: ../index.php");
    exit();
}

$userid = $_SESSION['userid'];

// Fetch customer data if `customerid` is set
$customer = null;
if (isset($_GET['customerid'])) {
    $customerid = $_GET['customerid'];
    $customer = $database->get("customerdata", "*", ["customerid" => $customerid]);

    if (!$customer) {
        die("Customer not found.");
    }
} else {
    die("Invalid request.");
}

// Function to check button visibility
function canShowButton($database, $buttonName, $userid, $customerid) {
    $buttonData = $database->get("buttons_tbl", ["activeids", "inactiveids", "status"], [
        "buttonnames" => $buttonName,
        "customerid" => $customerid // Ensure the button is specific to the customer
    ]);

    if (!$buttonData) return false; // If no button data found, hide the button

    $status = $buttonData["status"];
    $activeIds = !empty($buttonData["activeids"]) ? explode(",", $buttonData["activeids"]) : [];
    $inactiveIds = !empty($buttonData["inactiveids"]) ? explode(",", $buttonData["inactiveids"]) : [];

    return ($status == 1) && in_array($userid, $activeIds) && !in_array($userid, $inactiveIds);
}

// Determine if the buttons should be displayed
$canEdit = canShowButton($database, "Edit Button", $userid, $customerid);
$canSubmit = canShowButton($database, "Submit Button", $userid, $customerid);

// Redirect if user does not have permission
$redirect = !$canEdit && !$canSubmit;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <?php if ($redirect): ?>
    <script>
        setTimeout(function() {
            window.location.href = "view_users.php"; // Change to your desired redirect page
        }, 5000);
    </script>
    <?php endif; ?>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4 text-center">Edit Customer</h2>

        <form action="update_customer.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="customerid" value="<?= $customer['customerid'] ?>">
            <input type="hidden" name="userid" value="<?= $userid ?>">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="fullname" value="<?= $customer['fullname'] ?>" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="<?= $customer['email'] ?>" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="text" name="customernumber" value="<?= $customer['customernumber'] ?>" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" name="location" value="<?= $customer['location'] ?>" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Profile Image</label>
                    <input type="file" name="customerimage"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                </div>

                <?php if ($canEdit || $canSubmit) : ?>
                <div class="flex items-end">
                    <?php if ($canEdit): ?>
                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition">
                        Update Customer
                    </button>
                    <?php endif; ?>

                    <?php if ($canSubmit): ?>
                    <button type="submit" formaction="submit_customer.php"
                        class="w-full bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 transition">
                        Submit Customer
                    </button>
                    <?php endif; ?>
                </div>
                <?php else : ?>
                <div class="text-center text-red-500 font-semibold col-span-2">
                    You do not have permission to edit or submit this customer. You will be redirected in 5 seconds.
                </div>
                <?php endif; ?>
            </div>
        </form>
    </div>
</body>
</html>
