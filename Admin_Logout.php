<?php
// Start the session
session_start();

// Destroy all session variables
session_destroy();

// Redirect to the login page
header("Location: Admin_Index.php");
exit();
?>
