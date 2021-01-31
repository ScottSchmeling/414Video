<?php
include('account_system.inc.php');
include('transactions_system.inc.php');
require ('mysqli_connect.php'); //Connect to the db
?>
<link rel="stylesheet" type="text/css" href="style.css">
<!DOCTYPE html>
<html lang="en">
<head>
<style>
.logo
{
    width: 100%;
    height: 75px;
    padding-left: 5%;
    margin-bottom: 2%;
}
ul{
 width: 100%;
 height: 40px;
 margin-bottom:40px;
 padding-left:0;
}
ul li{
 list-style: none;   
 width: 25%;
 height: 40px;
 float: left;
 background-color: Black;
 text-align: center;
 line-height: 40px;
 }
ul li a{
width: 100%;
 height: 40px;
 display: inline-block;
 background-color: black;
 }
ul li a:link{
 color:white;
 text-decoration: none;
 background-color: black;
 }
ul li a:hover{
 color:white;
 background-color: #cccccc;
 }
ul li a:active{
 color: yellow;
 }
</style>
</head>
<body>
<!--logo add index.php-->
<div class="logo"><a href="index.php"> <img src="img/logo.png" alt="414 Logo" height="100" width="200"/></a></div>
<ul>
    <li><a href="search.php">Search</a></li>
    <li><a href="account.php">Account</a></li>
    <?php if(isStaff()) :?>
    <li><a href="staff.php">Staff</a></li>
    <?php else:?>
    <li></li>
    <?php endif;
    if(isAdmin()) :?>
    <li><a href="admin_page.php">Admin</a></li>
    <?php else:?>
    <li></li>
    <?php endif;?>
</ul>
</body>
</html>
   
   
    
    

