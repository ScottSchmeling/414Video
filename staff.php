<?php
include('header.php');

//echos a table with the active transactions
//$con = datebase conection
function printTransactionTable($con)
{
    echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
    <tr><td align="left"><b>Name</b></td><td align="left"><b>Movie</b></td><td align="left"><b>Status</b></td><td align="left"><b>Date</b></td></tr>';
    foreach (getAllTransaction($con) as $value)
    {
        echo '<tr class="selector"><td align="left">' . $value['firstName'] . ' ' .$value['lastName']. '</td><td align="left">' . $value['title'] . '</td><td align="left">' . $value['transctionType'] . '</td>
        <td aling="left">'.$value['lastUpdate'].'</td>'.createUpdateLink($value).'</tr>';
    }
    echo '</table>'; // Close the table.
}

//returns a table cell with a link to update the transaction
function createUpdateLink($entry)
{
    //the transaction current type
    $type = $entry['transctionType'];
    $link = null;
    switch($type)
    {
        case "reserved":
            $link = '<a href="staff_update_transaction.lin.php?movie='. $entry['movieID'] .'&order=' . $entry['orderID'].'&type=rent">Rent</a>';
        break;
        case "rented":
            $link = '<a href="staff_update_transaction.lin.php?movie='. $entry['movieID'] .'&order=' . $entry['orderID'].'&type=return">Return</a>';
        break;
    }
    $cancel = '<a href="staff_update_transaction.lin.php?movie='. $entry['movieID'] .'&order=' . $entry['orderID'].'&type=cancel">Cancel</a>';
    return '<td aling="center">'.$link.'</td><td aling="center">'.$cancel.'</td>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Control Panel</title>
</head>
<body>
    <?php if (isStaff()) :?>
        <center><h1>Staff Page</h1></center>
        <div style="float:left; width:50%; margin:10px; overflow-y:scroll; height:25%">
            <?php printTransactionTable($dbc) ?>
        </div>
        <div style="float:right; width:40%; margin:10px;">
            <?php include('staff_add_movie_form.inc.php'); ?>
            <p>You can edit movies on the availability page</p>
        </div>
    <?php else: ?>
        <p>You do not belong here</p>
    <?php endif; ?>
    <? include('footer.php'); ?>
</body>
</html>