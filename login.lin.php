<?php # Script 12.12 - login.php #4
// This page processes the login form submission.
// The script now stores the HTTP_USER_AGENT value for added security.

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Need two helper files:
	include('error_messages.inc.php');
	require ('account_system.inc.php');
	require ('mysqli_connect.php');	
	// Check the login:
	list ($check, $data) = check_login($dbc, $_POST['username'], $_POST['password']);
	
	if ($check) { // OK!
		
		// Set the session data:
		session_start();
		$_SESSION['user_id'] = $data['pKUserID'];
		$_SESSION['first_name'] = $data['first_name'];
		$_SESSION['user_type'] = $data['userType'];
		
		// Store the HTTP_USER_AGENT:
		$_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

			
	} else { // Unsuccessful!

		// Assign $data to $errors for login_page.inc.php:
		$errors = $data;
		if (isset($errors) && !empty($errors)) {
			setError('login_err', $errors);
		}
	}
		
	mysqli_close($dbc); // Close the database connection.
	// Redirect:
	redirect_user($_SESSION['login_redirect']);

} // End of the main submit conditional.
?>