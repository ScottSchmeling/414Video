<?php
include('account_system.inc.php');
include('transactions_system.inc.php');
require ('mysqli_connect.php'); //Connect to the db
include('error_messages.inc.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isStaff())
    {
        $errors = array(); // Initialize an error array.
	
	if (empty($_POST['title'])) {
		$errors[] = 'You forgot to enter title.';
	} else {
		$title = mysqli_real_escape_string($dbc, trim($_POST['title']));
	}
	
	if (empty($_POST['genre'])) {
		$errors[] = 'You forgot to enter genre.';
	} else {
		$genre = mysqli_real_escape_string($dbc, trim($_POST['genre']));
	}
	
	if (empty($_POST['price'])) {
		$errors[] = 'You forgot to enter price.';
	} else {
		$price = mysqli_real_escape_string($dbc, trim($_POST['price']));
	}

	//check for a username
	if (empty($_POST['videoLink'])) {
		$errors[] = 'You forgot to enter a trailer link.';
		
	} else {
        $video = str_replace ( "https://www.youtube.com/watch?v=", "", trim($_POST['videoLink']));
        $video = mysqli_real_escape_string($dbc, $video);
	}

        if(empty($errors))
        {
            $platform = mysqli_real_escape_string($dbc, trim($_POST['platform']));
            $query =  "INSERT INTO movies(title, genre, platform, rentalPrice, available, videoLink)
            VALUES ('$title','$genre','$platform', $price, 1, '$video')";
            $result = @mysqli_query ($dbc, $query); // Run the query.

            if(!$result)
            {
                echo '<h1>System Error</h1>
                    <p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
                
                    // Debugging message:
                    echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>';
            }
            redirect_user('availability.php?title='.$title.'&video='.$video);
        }
        else
        {
            setError('add_movie', $errors);
        }
    }
}
redirect_user('staff.php');
?>