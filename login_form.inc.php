<?php
include('error_messages.inc.php');
$errors = getErrors('login_err');

if(isset($errors)):?>
	<div style="background-color: red; text-align: center;">
	<?php
	foreach($errors as $value)
	{
		echo"$value<br>";
	}
	?>
	</div>
<? endif; ?>
<h1>Login</h1>
<form action="login.lin.php" method="post">
	<p>Username: <input type="text" name="username" size="20" maxlength="60" /> </p>
	<p>password: <input type="password" name="password" size="20" maxlength="20" /></p>
	<p><input type="submit" name="submit" value="Login" /></p>
</form>
<p><a href='register.php'>Don't have an account?</a></p>