<?php
include('header.php');

function displayOptions($col, $con)
{
    $query = "SELECT DISTINCT $col FROM movies";
    $result = mysqli_query ($con, $query);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        echo"<option value=\"".$row[$col]."\">".$row[$col]."</option>";
    }
}
?>
<html> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <style>
            form
            {
                padding-left:10%;
            }
        </style>
    </head>
    <body>
        <form action="search.php" method="post">
	        Search: </lable><input type="text" name="title" size="100%" maxlength="255" value="<?php if (isset($_POST['title'])) echo $_POST['title']; ?>"/>
            <select name="genre" id="genra">
                <option value="0">Filter by Genre</option>
                <?php displayOptions("genre",$dbc);?>
            </select>
            <select name="platform" id="platform">
                <option value="0">Filter by Platform</option>
                <?php displayOptions("platform",$dbc);?>
            </select>
            <input type="submit" name="submit" value="Enter!" />
        </form>
        <div style="height:60%; width:75%; overflow-y:scroll; margin:auto"><?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
            $genre = $_POST['genre'];
            $platform = $_POST['platform'];
            $filters = null;
            $query = null;
            $result = null;
            if($genre != "0")
            {
                $filters = "AND genre = '$genre'";
            }
            if($platform != "0")
            {
                if(is_null($filters))
                {
                    $filters = "AND platform = '$platform'";
                }
                else
                {
                    $filters = $filters." AND platform = '$platform'";
                }
            }
            if(is_null($filters))
            {
                $query = "SELECT DISTINCT title, genre, videoLink FROM movies WHERE title LIKE '%$title%' ORDER BY genre, title";
                $result = mysqli_query ($dbc, $query);
            }
            else
            {
                $query = "SELECT DISTINCT title, genre, videoLink FROM movies WHERE title LIKE '%$title%' $filters ORDER BY genre, title";
                $result = mysqli_query ($dbc, $query);
            }
            // Count the number of returned rows:
            $num = mysqli_num_rows($result);

            if ($num > 0) { // If it ran OK, display the records.
                // Table header.
                echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
                <tr><td align="left"><b>Title</b></td><td align="left"><b>Genre</b></td></tr>';
	
	            // Fetch and print all the records:
	            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo '<tr class="selector"><td align="left">' . $row['title'] . '</td><td align="left">' . $row['genre'] . '</td>
                    <td aling="right"><a href="availability.php?title='.$row['title'].'&video='.$row['videoLink'].'">View Availability</a></td></tr>';
                }
                echo '</table>'; // Close the table.
                mysqli_free_result ($result); // Free up the resources.	
            } 
            else 
            { // If no records were returned.
                echo '<p>Sorry No Matches</p>';
            }
        }
        else
        {
            $query = "SELECT DISTINCT title, genre, videoLink FROM movies ORDER BY genre, title";
            $result = mysqli_query ($dbc, $query);
            mysqli_num_rows($result);
            // Table header.
            echo '<table align="center" cellspacing="3" cellpadding="3" width="100%">
            <tr><td align="left"><b>Title</b></td><td align="left"><b>Genre</b></td></tr>';
            // Fetch and print all the records:
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo '<tr class="selector"><td align="left">' . $row['title'] . '</td><td align="left">' . $row['genre'] . '</td>
                <td aling="right"><a href="availability.php?title='.$row['title'].'&video='.$row['videoLink'].'">View Availability</a></td></tr>';
            }
            echo '</table>'; // Close the table.
            mysqli_free_result ($result); // Free up the resources.	
        }
        ?></div>
        <? include('footer.php'); ?>
    </body>
</html>