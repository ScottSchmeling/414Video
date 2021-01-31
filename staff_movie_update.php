<?php
include('header.php');


if(isStaff()):
    $errors = array(); // Initialize an error array.
    
    	// Check for a movieID
	if (empty($_GET['id'])) {
		$errors[] = 'There is no ID.';
	} else {
		$id = mysqli_real_escape_string($dbc, trim($_GET['id']));
    }


    //if the user updates the movie
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (empty($_POST['title'])) {
            $errors[] = 'You forgot to enter title.';
        } else {
            $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
        }
        
        if (empty($_POST['genre'])) {
            $errors[] = 'You forgot to enter genre.';
        } else {
            $genre = mysqli_real_escape_string($dbc, trim($_POST['genre']));
        }
        
        if (empty($_POST['price'])) {
            $errors[] = 'You forgot to enter price.';
        } else {
            $price = mysqli_real_escape_string($dbc, trim($_POST['price']));
        }
    
        //check for a username
        if (empty($_POST['videoLink'])) {
            $errors[] = 'You forgot to enter a trailer link.';
            
        } else {
            $video = str_replace ( "https://www.youtube.com/watch?v=", "", trim($_POST['videoLink']));
            $video = mysqli_real_escape_string($dbc, $video);
        }

        if (empty($errors)) { // If everything's OK.
            // Register the user in the database...
            // Make the query:
            $q = "UPDATE movies SET title = '$title', genre = '$genre', rentalPrice= $price, videoLink = '$video' WHERE pKMovieID = $id";
            $r = @mysqli_query($dbc, $q);
            if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
            
                // Print a message:
                echo '<h1>Thank you!</h1>
            <p>You have updated the movie listed.<br>';
            
            
            }
        }
        
    }
    $query = "SELECT title, genre, rentalPrice, videoLink FROM movies WHERE pKMovieID = $id";
    $result = mysqli_query ($dbc, $query);

    $num = mysqli_num_rows($result);
    if($num == 1)
    {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $entry = array(
                'title' => $row['title'],
                'genre' => $row['genre'],
                'rentalPrice' => $row['rentalPrice'],
                'videoLink' => $row['videoLink']
            );
        }
    }

    $url = 'https://www.youtube.com/watch?v='.$entry['videoLink'];
    if(!empty($errors)):?>
        <div style="background-color: red; text-align: center;">
            <?php
            foreach($errors as $value)
            {
                echo"$value<br>";
            }
            ?>
        </div>
    <? endif;?>
    <h1>Update Movie</h1>
    <form action="staff_movie_update.php?id=<? echo $id; ?>" method="post">
	<p>Title: <input type="text" name="title" size="20" maxlength="255" value="<? echo $entry['title']; ?>" /></p>
	<p>Genre: <input type="text" name="genre" size="20" maxlength="255" value="<? echo $entry['genre']; ?>"/></p>
    <p>Price: <input type="number" step="0.01" name="price" value="<? echo $entry['rentalPrice']; ?>" /></p>
    <p>Youtube Link: <input type="url" name="videoLink" value="<? echo $url; ?>"/></p>
	<p><input type="submit" name="submit" value="Update Movie" /></p>
    </form>
<?
endif;

?>
<? include('footer.php'); ?>