<?php
session_start();
require 'config/connection.php'; // Ensure Medoo connection is in this file

// Redirect if not logged in
if (!isset($_SESSION['userid'])) {
    header("Location: ../index.php");
    exit();
}

$userid = $_SESSION['userid'];
$email = $_SESSION['email'];

// Fetch workid of logged-in user
$workid = $database->get("users_tbl", "workid", ["userid" => $userid]);

// Fetch permission details
$permission = $database->get("permit", ["can_add", "hide_add"], [
    "AND" => [
        "OR" => [
            "userid" => $userid,
            "email" => $email
        ],
        "links" => "add_user.php"
    ]
]);

$canAdd = $permission['can_add'] ?? 0;
$hideAdd = $permission['hide_add'] ?? '';

// Check if current user is in the restricted list
$restrictedUsers = explode(',', $hideAdd);
if (in_array($userid, $restrictedUsers)) {
    $canAdd = 0;
}

if ($canAdd == 0) {
    echo "<script>
        setTimeout(function() {
            window.location.href = 'admin.php';
        }, 10000);
    </script>";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $rank = trim($_POST['rank']);
    $firstname = trim($_POST['firstname']);
    $surname = trim($_POST['surname']);
    $othername = trim($_POST['othername']);
    $maritalStatus = trim($_POST['maritalStatus']);
    $option = trim($_POST['option']);
    $gender = trim($_POST['gender']);
    $customerEmail = trim($_POST['email']);
    $customeremail = trim($_POST['customeremail']);
    $customernumber = 'OKRU-CUS-' . random_int(1000000000, 9999999999);
    $fullname = trim("$firstname $othername $surname");
    $connumber = trim($_POST['connumber']);
    $idnumber = trim($_POST['idnumber']);
    $location = trim($_POST['location']);

    // Check if email already exists
    if ($database->has("customerdata", ["email" => $customerEmail])) {
        echo "<script>
            alert('Error: Email already exists! Cannot insert data.');
            window.location.href = 'add_user.php';
        </script>";
        exit();
    }

    // Insert into the customerdata table
    $insert = $database->insert("customerdata", [
        "userid" => $userid,
        "workid" => $workid,
        "rank" => $rank,
        "firstname" => $firstname,
        "surname" => $surname,
        "othername" => $othername,
        "maritalStatus" => $maritalStatus,
        "options" => $option,
        "gender" => $gender,
        "email" => $customerEmail,
        "customeremail" => $customeremail,
        "customernumber" => $customernumber,
        "connumber" => $connumber,
        "idnumber" => $idnumber,
        "fullname" => $fullname,
        "location" => $location
    ]);

    if ($insert->rowCount() > 0) {
        // Update can_add permission to 0
        $database->update("permit", ["can_add" => 0], [
            "AND" => [
                "OR" => ["userid" => $userid, "email" => $email],
                "links" => "add_user.php"
            ]
        ]);

        echo "<script>
            alert('Customer added successfully!');
            window.location.href = 'admin.php';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Failed to insert customer data.');
            window.location.href = 'add_user.php';
        </script>";
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Customer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-6 rounded-lg shadow-lg w-3/4">
            
        
            <h1 class="text-2xl font-bold text-center sticky top-0 bg-white py-2 z-10">Add Customer</h1>


            <p id="timer" class="text-red-500 text-center font-bold mt-2">Redirecting in 10 seconds...</p>

            <?php if ($canAdd == 1 || $canAdd == 2 || $canAdd == 3): ?>
                <form action="add_user.php" method="POST" id="customerForm">
                    <!-- Scrollable Form Fields -->
                    <div class="grid grid-cols-2 gap-6 max-h-[400px] overflow-y-auto px-4">
                        
                        <!-- Left Side -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">User ID</label>
                            <input type="text" name="userid" value="<?= htmlspecialchars($userid) ?>" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-200">

                            <label class="block text-sm font-medium text-gray-700 mt-3">Work ID</label>
                            <input type="text" name="workid" value="<?= htmlspecialchars($workid) ?>" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-200">
                            <label class="block text-sm font-medium text-gray-700 mt-3">User email</label>
                            <input type="email" name="customeremail"value="<?= htmlspecialchars($email) ?>" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <label class="block text-sm font-medium text-gray-700 mt-3">Rank</label>
                            <select name="rank" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                <option value="MR">Mr</option>
                                <option value="MRS">Mrs</option>
                                <option value="MISS">Miss</option>
                            </select>

                            <label class="block text-sm font-medium text-gray-700 mt-3">First Name</label>
                            <input type="text" name="firstname" required class="w-full px-3 py-2 border border-gray-300 rounded-md">

                            <label class="block text-sm font-medium text-gray-700 mt-3">Surname</label>
                            <input type="text" name="surname" required class="w-full px-3 py-2 border border-gray-300 rounded-md">

                            <label class="block text-sm font-medium text-gray-700 mt-3">Other Name</label>
                            <input type="text" name="othername" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <label class="block text-sm font-medium text-gray-700 mt-3">Email</label>
                            <input type="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            <label class="block text-sm font-medium text-gray-700 mt-3">Contact Number</label>
                             <input type="number" name="connumber" maxlength="10" required class="w-full px-3 py-2 border border-gray-300 rounded-md">


                            <label class="block text-sm font-medium text-gray-700 mt-3">Idnumber</label>
                            <input type="number" name="idnumber" maxlength="11" required class="w-full px-3 py-2 border border-gray-300 rounded-md" oninput="validateInput(this)">

                            <label class="block text-sm font-medium text-gray-700 mt-3">Location</label>
<input list="locationOptions" name="location" required class="w-full px-3 py-2 border border-gray-300 rounded-md" placeholder="Type or select...">
<datalist id="locationOptions">
    <option value="Adweso">Adweso</option>
    <option value="Adwso">Adwso</option>
    <option value="Betom">Betom</option>
    <option value="Soroda">Soroda</option>
</datalist>
                        </div>

                        <!-- Right Side -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Marital Status</label>
                            <select name="maritalStatus" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                <option value="1">Married</option>
                                <option value="2">Single</option>
                            </select>

                            <label class="block text-sm font-medium text-gray-700 mt-3">Option</label>
                            <select name="option" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                <option value="loans">Loans</option>
                                <option value="savings">Savings</option>
                                <option value="both">Both</option>
                            </select>

                            <label class="block text-sm font-medium text-gray-700 mt-3">Gender</label>
                            <select name="gender" required class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>

                    <!-- Fixed Submit Button -->
                    <div class="mt-6 text-center sticky bottom-0 bg-white py-4 z-10">
                        <?php if ($canAdd == 1): ?>
                            <button type="submit" class="px-6 py-2 bg-green-500 hover:bg-green-700 text-white rounded-md">
                                Add Customer
                            </button>
                        <?php elseif ($canAdd == 2): ?>
                            <button type="submit" class="px-6 py-2 bg-gray-500 text-white rounded-md cursor-not-allowed" disabled>
                                Add Customer
                            </button>
                        <?php elseif ($canAdd == 3): ?>
                            <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md">
                                Add Customer (Submitted)
                            </button>
                        <?php endif; ?>
                    </div>
                </form>
            <?php else: ?>
                <p class="mt-4 text-red-500 text-center">You do not have permission to add customers.</p>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let countdown = 10; 
        let timerElement = document.getElementById("timer");
        let form = document.getElementById("customerForm");
        let inputs = form.querySelectorAll("input, select");
        let timerActive = true; 

        function updateTimer() {
            if (timerActive) {
                if (countdown > 0) {
                    timerElement.textContent = `Redirecting in ${countdown} seconds...`;
                    countdown--;
                    setTimeout(updateTimer, 1000);
                } else {
                    window.location.href = "admin.php";
                }
            }
        }

        // Detect any user interaction and stop the timer
        inputs.forEach(input => {
            input.addEventListener("input", () => {
                timerActive = false;  
                timerElement.textContent = "Input detected, timer stopped.";
            });

            input.addEventListener("change", () => {
                timerActive = false;
                timerElement.textContent = "Selection made, timer stopped.";
            });
        });

        // Start countdown
        updateTimer();
    </script>

</body>
</html>