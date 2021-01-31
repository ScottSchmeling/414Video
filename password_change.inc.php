<?php
include('error_messages.inc.php');
require ('mysqli_connect.php'); //Connect to the db

$errors = getErrors('pass_change');
$message = getErrors('sus_change');
if(isset($errors)):?>
    <div style="background-color: red; text-align: center; width=100%">
    <?php
    foreach($errors as $value)
    {
        echo"$value<br>";
    }
    ?>
    </div>
    <?php
    endif;
if(isset($message)):?>
<div style="background-color: green; text-align: center; width=100%">
<?php
foreach($message as $value)
{
	echo"$value<br>";
}
?>
</div>
<?php
endif;
?>
<h3>Change Your Password</h3>
<form action="password_change.lin.php" method="post">
<p>Current Password: <input type="password" name="pass" size="10" maxlength="20" value="<?php if(isset($_POST['pass']))echo $_POST['pass']; ?>" /></p>
<p>New Password: <input type="password" name="pass1" size="10" maxlength="20" value="<?php if(isset($_POST['pass1']))echo $_POST['pass1']; ?>" /></p>
<p>Confirm New Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php if(isset($_POST['pass2']))echo $_POST['pass2']; ?>" /></p>
<p><input type="submit" name="submit" value="Change Password"/></p>
</form>