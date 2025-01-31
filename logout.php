<?php
session_start();

// Destroy session data
session_unset();
session_destroy();

// Redirect to signin page
header("Location: signin.php");
exit();
?>
