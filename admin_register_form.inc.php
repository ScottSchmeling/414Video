<?php # Script 9.5 - register.php #2
include('error_messages.inc.php');
$errors = getErrors('admin_add');
if(isset($errors)):?>
<div style="background-color: red; text-align: center; width=100%">
<?php
foreach($errors as $value)
{
	echo"<p>$value</p><br>";
}
?>
</div>
<?php
endif;
if(isAdmin()):
?>
<h1>Add User</h1>
<form action="admin_add_user.lin.php" method="post">
<p>User Type: <select name="type">
        <option value="customer">Customer</option>
        <option value="staff">Staff</option>
        <option value="admin">Admin</option>
    </select></p>
	<p>First Name: <input type="text" name="first_name" size="15" maxlength="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>
	<p>Last Name: <input type="text" name="last_name" size="15" maxlength="40" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
	<p>Username: <input type="text" name="username" size="15" maxlength="40" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>"  /> </p> 
	<p>Password: <input type="password" name="pass1" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /></p>
	<p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /></p>
	<p><input type="submit" name="submit" value="Add User" /></p>
</form>
<?php endif; ?>