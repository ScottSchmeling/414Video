<?php
include('header.php');

if(isAdmin()):

    function printSelection($option)
    {
        switch ($option)
        {
            case "customer":
                $str = '<option value="customer">Customer</option>
                <option value="staff">Staff</option>
                <option value="admin">Admin</option>';
            break;
            case "staff":
                $str = '<option value="staff">Staff</option>
                <option value="customer">Customer</option>
                <option value="admin">Admin</option>';
            break;
            case "admin":
                $str = '<option value="admin">Admin</option>
                <option value="staff">Staff</option>
                <option value="customer">Customer</option>';
            break;
        }
        return $str;
    }


    $errors = array(); // Initialize an error array.
    
    	// Check for a movieID
	if (empty($_GET['id'])) {
		$errors[] = 'There is no ID.';
	} else {
		$id = mysqli_real_escape_string($dbc, trim($_GET['id']));
    }


    //if the user updates the movie
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (empty($_POST['first_name'])) {
            $errors[] = 'You forgot to enter first name.';
        } else {
            $fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
        }
        
        if (empty($_POST['last_name'])) {
            $errors[] = 'You forgot to enter last name.';
        } else {
            $ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
        }
        
        if (empty($_POST['email'])) {
            $errors[] = 'You forgot to enter email.';
        } else {
            $em = mysqli_real_escape_string($dbc, trim($_POST['email']));
        }
    
        //check for a username
        if (empty($_POST['userType'])) {
            $errors[] = 'You forgot to enter a user type.';
            
        } else {
            $ut = mysqli_real_escape_string($dbc, trim($_POST['userType']));
        }

        if (empty($errors)) { // If everything's OK.
            // Register the user in the database...
            // Make the query:
            $q = "UPDATE users SET first_name = '$fn', last_name = '$ln', email = '$em', userType = '$ut' WHERE pKUserID = $id";
            $r = @mysqli_query($dbc, $q);
            if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
            
                // Print a message:
                echo '<h1>Thank you!</h1>
            <p>You have updated the user listed.<br>';
            }
        }

        $query = "SELECT first_name, last_name, email, userType FROM users WHERE pKUserID = $id";
        $result = mysqli_query ($dbc, $query);
        $num = mysqli_num_rows($result);
        if($num == 1)
        {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $entry = array(
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'email' => $row['email'],
                    'userType' => $row['userType']
                );
            }
        }
        
    }

    $query = "SELECT first_name, last_name, email, userType FROM users WHERE pKUserID = $id";
    $result = mysqli_query ($dbc, $query);
    $num = mysqli_num_rows($result);
    if($num == 1)
    {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $entry = array(
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'email' => $row['email'],
                'userType' => $row['userType']
            );
        }
    }

    if(!empty($errors)):?>
        <div style="background-color: red; text-align: center;">
            <?php
            foreach($errors as $value)
            {
                echo"$value<br>";
            }
            ?>
        </div>
    <? endif;?>
    <h1>Update Users</h1>
    <form action="admin_user_update.php?id=<? echo $id; ?>" method="post">
	<p>First Name: <input type="text" name="first_name" size="15" maxlength="20" value="<? echo $entry['first_name']; ?>" /></p>
	<p>Last Name: <input type="text" name="last_name" size="15" maxlength="40" value="<? echo $entry['last_name']; ?>"/></p>
    <p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="<? echo $entry['email']; ?>" /></p>
    <p>User Type: <select name="userType">
    <? echo printSelection($entry['userType']); ?>
    </select></p>
	<p><input type="submit" name="submit" value="Update User" /></p>
    </form>
<?
endif;

?>
<? include('footer.php'); ?>