<?php
session_start();
require 'config/connection.php'; // Ensure Medoo connection is properly set up

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

$error = ""; // Default error message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Fetch user by username
    $user = $database->get("users_tbl", [
        "userid", "fullname", "email", "password", "role", "status", "process"
    ], ["username" => $username]);

    if ($user) {
        // Check if the account is blocked
        if ($user['process'] == 0) {
            $error = "Your account is blocked. Contact the administrator.";
        }
        // Check if already logged in
        elseif ($user['status'] === 'active' && $user['process'] == 1) {
            $error = "You are already logged in from another device.";
        }
        // Verify password
        elseif (password_verify($password, $user['password'])) {
            // Reset login attempts on successful login
            $_SESSION['login_attempts'] = 0;

            // Update user status
            $database->update("users_tbl", ["status" => "active", "process" => 1], [
                "userid" => $user['userid']
            ]);

            // Insert login record into logs table
            $database->insert("logs", [
                "username" => $username,
                "email" => $user['email'],
                "activity" => "Login",
                "logintime" => date("Y-m-d H:i:s"),
                "logouttime" => NULL
            ]);

            // Set session variables
            $_SESSION['userid'] = $user['userid'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            header("Location: admin.php");
            exit();
        } else {
            // Increment login attempts in session
            $_SESSION['login_attempts']++;

            if ($_SESSION['login_attempts'] >= 3) {
                // Block account after 3 failed attempts
                $database->update("users_tbl", ["process" => 0], ["userid" => $user['userid']]);
                $error = "Account blocked due to multiple failed attempts. Contact administrator.";
                $_SESSION['login_attempts'] = 0; // Reset after blocking
            } else {
                $error = "Invalid username or password.";
            }
        }
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
  <div class="bg-white p-8 rounded-lg shadow-lg w-96">
    <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>

    <?php if (!empty($error)): ?>
      <script>
        // Prevent multiple pop-ups
        if (!sessionStorage.getItem('errorShown')) {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?= htmlspecialchars($error); ?>',
            showConfirmButton: false,
            timer: 3000
          }).then(() => {
            // Auto refresh if account is blocked
            <?php if (strpos($error, "blocked") !== false): ?>
              location.reload();
            <?php endif; ?>
          });

          sessionStorage.setItem('errorShown', 'true'); // Mark error as shown
        }
      </script>
    <?php endif; ?>

    <form method="POST" action="">
      <div class="mb-4">
        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
        <input type="text" name="username" id="username" required
               class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <div class="mb-6">
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" name="password" id="password" required
               class="w-full mt-1 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Login</button>
    </form>
  </div>
</body>
</html>
