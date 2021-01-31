<?php
include('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <?php if(isAdmin()) :?>
    <center><h1>Admin</h1></center>
    <div style="float:left; width:45%; padding-left:5%"><?php include('admin_register_form.inc.php'); ?></div>
    <div style="float:right; width:45%">
        <h2 style="margin:auto">View Users</h2>
        <div style="height:30%; overflow-y:scroll">
        <?php
            $query = "SELECT first_name, last_name, email, userName, userType, pKUserID FROM users ORDER BY userType, first_name, last_name";
            $result = mysqli_query ($dbc, $query);
            // Table header.
            echo '<table align="center" cellspacing="3" cellpadding="3" width="100%">
             <tr><td align="left"><b>Name</b></td><td align="left"><b>E-Mail</b></td><td align="left"><b>Username</b></td><td align="left"><b>Type</b></td></tr>';
	
	        // Fetch and print all the records:
	        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<tr class="selector"><td align="left">' . $row['first_name'] . ' ' .$row['last_name'].'</td><td align="left">' . $row['email'] . '</td>
                <td aling="right">' . $row['userName'] . '</td><td align="left">' . $row['userType'] . '</td><td align="left"><a href="admin_user_update.php?id='. $row['pKUserID'] .'">edit</a></td></tr>';
            }
            echo '</table>'; // Close the table.
            mysqli_free_result ($result); // Free up the resources.	
        ?>
        </div>
    </div>
    <?php endif;?>
    <? include('footer.php'); ?>
</body>
</html>
