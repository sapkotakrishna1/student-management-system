<?php

// Enable error reporting for debugging purposes
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start buffering output to prevent issues with session_start()
ob_start();

// Start the session
session_start();

// Destroy the session
session_destroy();

// Regenerate the session ID for enhanced security
session_regenerate_id();

// Redirect to the login page
header("Location: login.php");
exit;

?>
