<?php
include('account_system.inc.php');
include('transactions_system.inc.php');
require ('mysqli_connect.php'); //Connect to the db

$movieID = $_GET['movie'];
$orderID = $_GET['order'];

if(isset($movieID) and isset($orderID) and isLoggedIn())
{
    if(isUserOwnerTransaction($dbc, getID(), $orderID))
    {
        cancelTransaction($dbc, $movieID, $orderID);
    }
}

redirect_user ('account.php')

?>