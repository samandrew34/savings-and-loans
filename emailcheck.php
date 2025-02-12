<?php
session_start();
require 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure password hashing

    // Mailboxlayer API Key (Replace with your own key)
    $api_key = "YOUR_MAILBOXLAYER_API_KEY";

    // API URL
    $url = "http://apilayer.net/api/check?access_key=$api_key&email=$email&format=1";

    // Make API request
    $response = file_get_contents($url);
    $result = json_decode($response, true);

    if ($result['format_valid'] && $result['smtp_check']) {
        // Email is valid and exists
        $stmt = $conn->prepare("INSERT INTO users_tbl (fullname, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullname, $email, $password);

        if ($stmt->execute()) {
            echo "<script>
                alert('Registration successful!');
                window.location.href = 'emailcheck.php';
            </script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    } else {
        // Email is invalid or does not exist
        echo "<script>alert('Invalid email! Please use a valid email address.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="register.php" method="post">
        <input type="text" name="fullname" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
