<?php
include('header.php');
//get title
$title = mysqli_real_escape_string($dbc, trim($_GET['title']));
$videoLink = $_GET['video'];

function staffLink($id)
{
    if(isStaff())
    {
        return "<td align='right'><a href='staff_movie_update.php?id=$id'>Change</a></td>";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo"$title Availability";?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
    <div style="float:left; margin:5px">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo"$videoLink";?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <div style="float:right; width:45%; margin:5px">
    <h1><?php echo"$title";?></h1>
    <?php
    $query = "SELECT pKMovieID, title, platform, rentalPrice FROM movies WHERE title = '$title' AND available = 1";
    $result = mysqli_query ($dbc, $query);
    // Count the number of returned rows:
    $num = mysqli_num_rows($result);
    if ($num > 0)
    {
        // Table header.
        echo '<table align="left" cellspacing="3" cellpadding="3" width="75%">
        <tr><td align="left"><b>Title</b></td><td align="left"><b>Platform</b></td><td align="left"><b>Price</b></td></tr>';
        // Fetch and print all the records:
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo '<tr class="selector"><td align="left">' . $row['title'] . '</td><td align="left">' . $row['platform'] . '</td>
            <td align="left">' . $row['rentalPrice'] . '</td><td align="right"><a href="reserve.php?id='. $row['pKMovieID'] .'">Reserve Movie</a></td>'.staffLink($row['pKMovieID']).'</tr>';
        }
        echo '</table>'; // Close the table.
        mysqli_free_result ($result); // Free up the resources.	
    }
    else
    {
        echo '<p>Sorry None Available</p>';
    }
    ?>
    </div>
    <? include('footer.php'); ?>
    </body>
</html>