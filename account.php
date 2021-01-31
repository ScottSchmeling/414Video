<?php
include('header.php');

/*prints out the link to cancel a reservation
*$entry is an array of the current transaction
*if the transctionType is reserved, the link would be printed*/
function canPrintLink($entry)
{
    if(isset($entry) and $entry['transctionType'] == "reserved")
    {
        return '<a href="user_cancel.lin.php?movie='. $entry['movieID'] .'&order=' . $entry['orderID'].'">Cancel</a>';
    }
}
if(isLoggedIn())
{
    //get name
    $name = getFirstName();
    ?>
    <center><h1>Account Settings</h1></center>
    <div style="float:left; width:45%; margin:5px; margin-left:5%;">
        <h2>Hello <?php echo"$name"; ?></h2>
        <p><a href='logout.lin.php'>Logout here</a></p>
        <? include('password_change.inc.php'); ?>
    </div>
    <div style="float:right; width:45%; margin:5px">
    <?php
    $transactions = getUserTransaction($dbc, getID());
    if(isset($transactions) and !empty($transactions))
    {
        // Table header.
        echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
        <tr><td align="left"><b>Movie</b></td><td align="left"><b>Status</b></td><td align="left"><b>Date</b></td></tr>';
        foreach ($transactions as $value)
        {
            $link = canPrintLink($value);
            echo '<tr class="selector"><td align="left">' . $value['title'] . '</td><td align="left">' . $value['transctionType'] . '</td>
            <td aling="left">'.$value['lastUpdate'].'</td><td aling="right">'.$link.'</td></tr>';
        }
        echo '</table>'; // Close the table.
    }
    else
    {
        echo"<h3>You do not have any movies on reserved or rented</h3><br>
        <p><a href='search.php'>Get Started here</a></p>";
    }
    ?>
    </div>
<?php
}
else
{
    ?>
    <div style="float:left; width:45%; margin:5px; margin-left:5%;">
    <? display_login('account.php'); ?>
    </div>
    <?php
}
mysqli_close($dbc); // Close the database connection.
?>
<? include('footer.php'); ?>