<?php
// Start session
session_start();

// Destroy all session data
session_destroy();

// Redirect to index.php (login page)
header("Location: index.php");
exit;
?>