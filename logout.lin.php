<?php # Script 12.11 - logout.php #2
// This page lets the user logout.
// This version uses sessions.

include('account_system.inc.php');
session_start(); // Access the existing session.

// If no session variable exists, redirect the user:
if (!isLoggedIn()) {

	redirect_user('account.php');	
	
} else { // Cancel the session:

	$_SESSION = array(); // Clear the variables.
	session_destroy(); // Destroy the session itself.
	setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0); // Destroy the cookie.
	redirect_user('account.php');
}
?>