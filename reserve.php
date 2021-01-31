<?php
include('header.php');
$movieID = $_GET['id'];
if(isLoggedIn())
{
    if(isUnderLimit($dbc, getID()))
    {
        if(isMovieAvailable($dbc, $movieID))
        {
            if(createTransaction($dbc, getID(), $movieID))
            {
                echo"<p style=\"float:left; width:45%; margin:5px; margin-left:5%;\">Congrats, you reserved the movie</p><br>
                <p style=\"float:left; width:45%; margin:5px; margin-left:5%;\"><a href='account.php'>Look!</a></p>";
            }
            else{
                echo"<p style=\"float:left; width:45%; margin:5px; margin-left:5%;\">Sorry, there was an error!</p><br>
                <p><a href='search.php'>Click here to back to searching!</a></p>";
            }
        }
        else
        {
            echo"<p style=\"float:left; width:45%; margin:5px; margin-left:5%;\">Sorry, Movie is no logger available!</p><br>
                <p style=\"float:left; width:45%; margin:5px; margin-left:5%;\"><a href='search.php'>Click here to back to searching!</a></p>";
        }
    }
    else{
        echo"<p style=\"float:left; width:45%; margin:5px; margin-left:5%;\">Sorry, Movie limit has been reached!</p><br>
                <p style=\"float:left; width:45%; margin:5px; margin-left:5%;\"><a href='account.php'>Look!</a></p>";
    }
}
else
    {
        ?>
        <div style="float:left; width:45%; margin:5px; margin-left:5%;">
        <? display_login("reserve.php?id=$movieID"); ?>
        </div>
        <?php 
    }
?>
<? include('footer.php'); ?>

