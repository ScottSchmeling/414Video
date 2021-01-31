<?php
session_start();
/* This function determines an absolute URL and redirects the user there.
 * The function takes one argument: the page to be redirected to.
 * The argument defaults to index.php.
 */
function redirect_user ($page = 'index.php') {

	// Start defining the URL...
	// URL is http:// plus the host name plus the current directory:
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	
	// Remove any trailing slashes:
	$url = rtrim($url, '/\\');
	
	// Add the page:
	$url .= '/' . $page;
	
	// Redirect the user:
	header("Location: $url");
	exit(); // Quit the script.

} // End of redirect_user() function.

/* This function validates the form data (the email address and password).
 * If both are present, the database is queried.
 * The function requires a database connection.
 * The function returns an array of information, including:
 * - a TRUE/FALSE variable indicating success
 * - an array of either errors or the database result
 */
function check_login($dbc, $user = '', $password = '') {

	$errors = array(); // Initialize error array.

	// Validate the email address:
	if (empty($user)) {
		$errors[] = 'You forgot to enter your Username.';
	} else {
		$u = mysqli_real_escape_string($dbc, trim($user));
	}

	// Validate the password:
	if (empty($password)) {
		$errors[] = 'You forgot to enter your password.';
	} else {
        $p = mysqli_real_escape_string($dbc, trim($password));
	}

	if (empty($errors)) { // If everything's OK.

		// Retrieve the user_id and first_name for that email/password combination:
		$q = "SELECT pKUserID, first_name, userType FROM users WHERE userName='$u' AND pass='$p'";
		$r = mysqli_query ($dbc, $q); // Run the query.
		
		// Check the result:
		if (mysqli_num_rows($r) == 1) {

			// Fetch the record:
			$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
	
			// Return true and the record:
			return array(true, $row);
			
		} else { // Not a match!
			$errors[] = 'The email address and password entered do not match those on file.';
		}
		
	} // End of empty($errors) IF.
	
	// Return false and the errors:
	return array(false, $errors);

} // End of check_login() function.

//checks if the user is logged in
function isLoggedIn()
{
    return (isset($_SESSION['agent']) and ($_SESSION['agent'] == md5($_SERVER['HTTP_USER_AGENT'])));
}

//displays the login form
//include where you want it to redirect
function display_login($page = 'index.php')
{
    $_SESSION['login_redirect'] = $page;
    include('login_form.inc.php');
}

//returns the user type 
function getUserType()
{
	return $_SESSION['user_type'];
}

//returns user's first name
function getFirstName()
{
	return $_SESSION['first_name'];
}

//returns user's ID
function getID()
{
	return $_SESSION['user_id'];
}

//returns if the user is a staff or an admin
function isStaff()
{
	return (isLoggedIn() and (getUserType() == "staff" or getUserType() == "admin"));
}

//returns if the user is an admin
function isAdmin()
{
	return (isLoggedIn() and (getUserType() == "admin"));
}
?>