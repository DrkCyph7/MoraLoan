<?php
session_start();

// Destroy the session to log the user out
session_unset();  // Remove all session variables
session_destroy();  // Destroy the session

// Redirect the user to the index page (or the login page)
header('Location: index.php');  // You can change this to 'login.php' if you prefer
exit;
?>