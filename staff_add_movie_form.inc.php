<?php # Script 9.5 - register.php #2
include('error_messages.inc.php');
$errors = getErrors('add_movie');
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
if(isStaff()):
?>
<h1>Add Movie</h1>
<form action="staff_add_movie.lin.php" method="post">
	<p>Title: <input type="text" name="title" size="20" maxlength="255" /></p>
	<p>Genre: <input type="text" name="genre" size="20" maxlength="255" /></p>
    <p>Platform: <select name="platform">
        <option value="DVD">DVD</option>
        <option value="Blu-Ray">Blu-Ray</option>
        <option value="VHS">VHS</option>
    </select></p>
    <p>Price: <input type="number" step="0.01" name="price"/></p>
    <p>Youtube Link: <input type="url" name="videoLink"/></p>
	<p><input type="submit" name="submit" value="Add Movie" /></p>
</form>
<? endif; ?>