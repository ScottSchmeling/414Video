<?php
/*checks if the movie is available
*$con = sql connection
*$id is movie ID
*returns if the movie is available*/
function isMovieAvailable($con, $id)
{
    
    $i = mysqli_real_escape_string($con, trim($id));
    $query = "SELECT * FROM movies WHERE pKMovieID = $i AND available = 1";
    $result = mysqli_query ($con, $query);
    // Count the number of returned rows:
    $num = mysqli_num_rows($result);
    if($num > 0){
        return true;
    }
    else{
        return false;
    }
}

/*checks if the user has reach the limit of transactions
*$con = sql connection
*$user = user's id
*$limit = the limit the user is allowed to be reserved or rented, default is 3
*returns if the user has reached the limited or not
*/
function isUnderLimit($con, $user, $limit = 3)
{
    $u = mysqli_real_escape_string($con, trim($user));
    $query = "SELECT * FROM transactions WHERE fkUserID = '$u' AND transctionType != 'returned'";
    $result = mysqli_query ($con, $query);
    $num = mysqli_num_rows($result);
    if($num < $limit){
        return true;
    }
    else{
        return false;
    }
}
/*gets the current transactions the user has
*$con = sql connection
*$user = user's id
*returns an array of user's transactions that are not returned
*/
function getUserTransaction($con, $user)
{
    $u = mysqli_real_escape_string($con, trim($user));

    //query
    $query = "SELECT t.transctionType AS type, DATE(t.lastUpdate) AS lastUpdate, m.title AS title, t.pKOrderNumber AS tNum, m.pKMovieID AS mNum
    FROM transactions AS t
    INNER JOIN movies AS m 
    ON t.fkMovieID = m.pKMovieID
    WHERE fkUserID = '$u' AND transctionType != 'returned'";

    $result = mysqli_query ($con, $query);
    $num = mysqli_num_rows($result);
    $allTrans = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        //current array
        $curr = array(
            "title" => $row['title'],
            "transctionType" => $row['type'],
            "lastUpdate" => $row['lastUpdate'],
            "movieID" => $row['mNum'],
            "orderID" => $row['tNum']
        );
        array_push($allTrans,$curr);
    }
    return $allTrans;
}

/*gets all current transactions 
*$con = sql connection
*returns an array of all  transactions that are not returned
*/
function getAllTransaction($con)
{

    //query
    $query = "SELECT t.pKOrderNumber AS tNum, m.pKMovieID AS mNum, u.pKUserID AS uNum, t.transctionType AS type, DATE(t.lastUpdate) AS lastUpdate, m.title AS title, 
    u.first_name AS firstName, u.last_name AS lastName
    FROM transactions AS t
    INNER JOIN movies AS m 
    ON t.fkMovieID = m.pKMovieID
    INNER JOIN users AS u
    ON t.fkUserID = u.pKUserID
    WHERE transctionType != 'returned'
    ORDER BY title, firstName, lastName";

    $result = mysqli_query ($con, $query);
    $num = mysqli_num_rows($result);
    $allTrans = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        //current array
        $curr = array(
            "title" => $row['title'],
            "transctionType" => $row['type'],
            "lastUpdate" => $row['lastUpdate'],
            "movieID" => $row['mNum'],
            "orderID" => $row['tNum'],
            "userID" => $row['uNum'],
            "firstName" => $row['firstName'],
            "lastName" => $row['lastName']
        );
        array_push($allTrans,$curr);
    }
    return $allTrans;
}

/*creates an transaction for a movie and user.
*$con = sql connection
*$user = user's id
*$movie = movie ID
*$type = transaction type, default reserved
*returns if the transaction was made
*DO NOT USE TO CREATE returned TRANSACTION
*/
function createTransaction($con, $user, $movie, $type = "reserved")
{
    $u = mysqli_real_escape_string($con, trim($user));
    $m = mysqli_real_escape_string($con, trim($movie));
    $t = mysqli_real_escape_string($con, trim($type));

    $query =  "INSERT INTO transactions (transctionType, lastUpdate, fkMovieID, fkUserID) VALUES ('$t', NOW(), $m, $u)";
    $result = @mysqli_query ($con, $query); // Run the query.
    //if the transaction was sussesful
    if($result)
    {
        //updates movies
        $q = "UPDATE movies SET available = 0 WHERE pKMovieID = $m";
        $r = @mysqli_query($con, $q);
        return true;
    }
    else{
        return false;
    }
}

/*Updates transaction to return
*$con = sql connection
*$movie = movie ID
*$order = transaction ID
*/
function returnTransaction($con, $movie, $order)
{
    $m = mysqli_real_escape_string($con, trim($movie));
    $o = mysqli_real_escape_string($con, trim($order));

    $query =  "UPDATE transactions SET transctionType = 'returned', lastUpdate = NOW() WHERE pKOrderNumber = $o";
    $result = @mysqli_query ($con, $query); // Run the query.
    if(mysqli_affected_rows($con) == 1)
    {
        $q = "UPDATE movies SET available = 1 WHERE pKMovieID = $m";
        $r = @mysqli_query($con, $q);
    }
    else
    {
        echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($con) . '<br /><br />Query: ' . $query . '</p>';
    }
}

/*Updates transaction to rented
*$con = sql connection
*$movie = movie ID
*$order = transaction ID
*/
function rentedTransaction($con, $movie, $order)
{
    $m = mysqli_real_escape_string($con, trim($movie));
    $o = mysqli_real_escape_string($con, trim($order));

    $query =  "UPDATE transactions SET transctionType = 'rented', lastUpdate = NOW() WHERE pKOrderNumber = $o";
    $result = @mysqli_query ($con, $query); // Run the query.
    if(mysqli_affected_rows($con) == 1)
    {
        $q = "UPDATE movies SET available = 0 WHERE pKMovieID = $m";
        $r = @mysqli_query($con, $q);
    }
    else
    {
        echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($con) . '<br /><br />Query: ' . $query . '</p>';
    }
}

/*cencels transaction
*$con = sql connection
*$movie = movie ID
*$order = transaction ID
*DELETES transactions and update movie
*/
function cancelTransaction($con, $movie, $order)
{
    $m = mysqli_real_escape_string($con, trim($movie));
    $o = mysqli_real_escape_string($con, trim($order));

    $query =  "DELETE FROM transactions WHERE pKOrderNumber = $o";
    $result = @mysqli_query ($con, $query); // Run the query.
    if($result)
    {
        $q = "UPDATE movies SET available = 1 WHERE pKMovieID = $m";
        $r = @mysqli_query($con, $q);
    }
    else
    {
        echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($con) . '<br /><br />Query: ' . $query . '</p>';
    }
}

/*checks if userID matches transaction ID
*$con = sql connection
*$user = uers ID
*$order = transaction ID
*returns if owner id is same on transaction
*/
function isUserOwnerTransaction($con, $user, $order)
{
    $u = mysqli_real_escape_string($con, trim($user));
    $o = mysqli_real_escape_string($con, trim($order));

    $query = "SELECT * FROM transactions WHERE pKOrderNumber = $o AND fkUserID = $u";
    $result = @mysqli_query ($con, $query); // Run the query.

    $num = mysqli_num_rows($result);
    if($num > 0){
        return true;
    }
    else{
        return false;
    }
}
?>