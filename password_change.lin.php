<?php
include('account_system.inc.php');
include('error_messages.inc.php');
require ('mysqli_connect.php'); //Connect to the db

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$errors = array();
	
	if (empty($_POST['pass'])){
		$errors[] = 'You forgot to enter your current password.';
	}
	else {
		$p = mysqli_real_escape_string($dbc, trim($_POST['pass']));
	}
	
	if (!empty($_POST['pass1'])){
		if ($_POST['pass1'] != $_POST['pass2']){
			$errors[] = 'Your new password did not match the confirmed password.';
		}
		else{
			$np = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	}
	    else{
			$errors[] = 'You forgot to enter your new password.';
	    }
		
	    if (empty($errors)){
			$id = getID();
			
			$q ="SELECT pKUserID FROM users WHERE (pKUserID=$id AND pass='$p'";
			$r = @mysqli_query($dbc, $q);
			$num = @mysqli_num_rows($r);
			if ($num ==1){
				
				$row = mysqli_fetch_array($r, MYSQLI_NUM);
				
				$q = "UPDATE users SET pass='$np' WHERE pKUserID=$row[0]";
				$r = @mysqli_query($dbc, $q);
				
				if (mysqli_affected_rows($dbc) == 1){
					
					$msg = array();
					$msg[] = 'Your password has been updated';
					setError('sus_change', $msg);
				}
				else{
					
					echo '<h1>System Error</h1>
					<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>';
					
					echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
				}
				mysqli_close($dbc);
				
			}
			else{
				$errors[] = 'password does not match the one on file.';
				setError('pass_change', $errors);
			}
		}
		else{
			setError('pass_change', $errors);
		}
}
redirect_user('account.php');
?>
