<?php
include('account_system.inc.php');
include('error_messages.inc.php');

if(isAdmin()):

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require ('mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}
	
	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}
	
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}

	//check for a username
	if (empty($_POST['username'])) {
		$errors[] = 'You forgot to enter a username.';
		
	} else {
		//checks if user name already exists
		$checkMulti = mysqli_real_escape_string($dbc, trim($_POST['username']));
		$query = "SELECT userName FROM users WHERE userName = '$checkMulti'";
		$result = mysqli_query ($dbc, $query);
		// Count the number of returned rows:
		$num = mysqli_num_rows($result);
		if($num > 0){
			$errors[] = 'Username Already Taken, please choose another one.';
		}
		else
		{
			$u = $checkMulti; 
		}
	}
	
	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
    }
    
    $t = $_POST['type'];

	if (empty($errors)) { // If everything's OK.
		// Register the user in the database...
		// Make the query:
		$q = "INSERT INTO users (first_name, last_name, email, userName, pass, userType) VALUES ('$fn', '$ln', '$e', '$u', SHA2('$p',224), '$t' )";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
        if (!$r)
        { // If it ran OK.
            $errors[] = "Didn't add user!";
            setError('admin_add', $errors);
        }
    }
    else
    {
        setError('admin_add', $errors);
    }
}
endif;
redirect_user ('admin_page.php');
?>