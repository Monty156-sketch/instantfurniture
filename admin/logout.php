<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Clear the remember me cookie
setcookie("remember_user", "", time() - 3600, "/");

// Redirect to login page
header("Location: login.php");
exit;
?>
