<?php
session_start();
require 'config/connection.php';

// Redirect if not logged in
if (!isset($_SESSION['userid'])) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerid = $_POST['customerid'];
    $userid = $_SESSION['userid'];

    // Fetch existing customer data
    $customer = $database->get("customerdata", "*", ["customerid" => $customerid]);

    if (!$customer) {
        header("Location: edit_user.php?error=Customer not found");
        exit();
    }

    // Prepare data for update
    $updateData = [
        "fullname" => $_POST['fullname'],
        "email" => $_POST['email'],
        "customernumber" => $_POST['customernumber'],
        "location" => $_POST['location']
    ];

    // Handle image upload
    if (!empty($_FILES["customerimage"]["name"])) {
        $targetDir = "../asset/customers/";
        $fileName = time() . "_" . basename($_FILES["customerimage"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Validate file type
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowedTypes)) {
            header("Location: edit_user.php?error=Invalid image format");
            exit();
        }

        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES["customerimage"]["tmp_name"], $targetFilePath)) {
            $updateData["customerimage"] = $fileName;
        } else {
            header("Location: edit_user.php?error=Image upload failed");
            exit();
        }
    }

    // Update the database
    $updateResult = $database->update("customerdata", $updateData, ["customerid" => $customerid]);

    if ($updateResult->rowCount() > 0) {
        header("Location: view_users.php?success=Customer updated successfully");
        exit();
    } else {
        header("Location: edit_user.php?error=Update failed");
        exit();
    }
} else {
    header("Location: edit_user.php?error=Invalid request");
    exit();
}
