<?php

require_once "config.php";

session_start();
//welcome user to page, display logged in user
echo 'Greetings ' . $_SESSION['username'] . '! If you see this page for more than a few seconds, it means an error has occured >_>. Below should hopefully a statement indicating the nature of the error. <br \> <br \>';
echo ('Currently logged in as: ' . $_SESSION['username'] . '<br \>');
echo ('<br \><br \>');

$username = $_SESSION['username'];          //get username from who's logged in, get user submitted answers from html form.
$artist = $_POST['artist'];
$song = $_POST['song'];
$rating = $_POST['rating'];

if (!ctype_digit($rating)) {            //if an integer wasn't submitted in the rating field
	echo "Please enter an integer value.";
	
}

if ($rating < 1 || $rating > 5) { 
    $input_error = "Rating must be in the range of 0 < x <= 5 <br>"; 
    echo $input_error;
}
    else{  
        echo "so in here";      
        $stmt = $conn->prepare("SELECT * FROM ratings WHERE username = ? AND artist = ? AND song = ?");
        //parameterize the check to see if the username/song/artist combo already exists in the data bata
		mysqli_stmt_bind_param($stmt, "sss", $username, $artist, $song);        
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 0){       // if the search returns nothing, then we can add it.
				mysqli_stmt_close($stmt);

				$stmt3 = $conn->prepare("INSERT INTO ratings (username, artist, song, rating) VALUES (?, ?, ?, ?)");
				mysqli_stmt_bind_param($stmt3, "sssi", $username, $artist, $song, $rating);
				$result3 = mysqli_stmt_execute($stmt3); 
				
				if($result3)    //if the execution of the insertion was successful, display that to the user
				{
					echo "Contact Records Inserted";
					header("location: reviewboard.php");
					exit();
				}
            } else{                   // if the search for the username/song/artist combo already exists, don't insert it again. error.
                echo "You've already input this song into our system! Try editing it, or deleting it and then posting it again."; 
                            }
        } else{
            echo "Uh oh, it seems sql wasn't able to execute the statement? Perhaps try again.";
        }
    }

?>
<!DOCTYPE html>
<html>
<head> 	<title> Review a song!</title>	 </head>

<body> 		<legend>		<h2>Thank you for your valuable opinion! :D</h2>	</legend>
<form name="frmContact" method="post" action="reviewboard.php">     
    <!-- take user to reviewboard  -->

<p> <input type="submit" name="You're welcome! Take me back to the music board" id="Submit" value="Okay, take me back to the homepage"> </p>		</form>		

<!-- take user back to addsong -->
<form name="frmContact" method="post" action="addsong.php">

<p> <input type="submit" name="take two baby, action!" id="Submit" value="Oops, let me try again"> </p>		</form>	</body>
</html>
