<?php # Script 12.6 - logout.php
# This page lets the user logout.

// Access the existing session
session_start();

require('includes/login_functions.inc.php');

// If no session variable exists...
if (!isset($_SESSION['user_id'])) {

    // Redirect the user:
    redirect_user();

} else { // If session variables exist...

    // Cancel the session:
    $_SESSION = []; // clear the variables
    session_destroy(); // destroy the session itself
    setcookie('PHPSESSID', '', time()-3600, '/', '', 0, 0); // destroy the cookie

    // Redirect the user:
    redirect_user();
}

?>