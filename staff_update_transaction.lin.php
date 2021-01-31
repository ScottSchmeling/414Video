<?php
include('account_system.inc.php');
//get the required values
$movieID = $_GET['movie'];
$orderID = $_GET['order'];
$type = $_GET['type'];

if (isStaff())
{
    include('transactions_system.inc.php');
    require ('mysqli_connect.php'); //Connect to the db

    switch ($type)
    {
        case "rent":
            rentedTransaction($dbc, $movieID, $orderID);
        break;
        case "return":
            returnTransaction($dbc, $movieID, $orderID);
        break;
        case "cancel":
            cancelTransaction($dbc, $movieID, $orderID);
        break;
    }
}
redirect_user("staff.php")
?>