<?php

require_once "config.php";

session_start();
echo 'Greetings ' . $_SESSION['username'] . '! If you see this page for more than a few seconds, it means an error has occured >_>. Below should hopefully a statement indicating the nature of the error. <br \> <br \>';
// echo ('Currently logged in as: ' . session_id($_GET['username']) . '<br \>');
// echo ('Currently logged in as: ' . $_SESSION['username'] . '<br \>');
echo ('<br \><br \>');

$con = mysqli_connect("localhost","root","","music_db");

$username = $_SESSION['username'];
$artist = $_POST['artist'];
$song = $_POST['song'];
$rating = $_POST['rating'];

// $sql = "INSERT INTO `ratings`  VALUES ('0', '$username', '$artist', '$song', '$rating')";

// $result = mysqli_query($con, $sql);

// if($result)
// {
// 	echo "Contact Records Inserted";
// 	header("location: reviewboard.php");
// 	exit();
// }

{
    $sql = "SELECT * FROM ratings WHERE username = '$username' AND artist = '$artist' AND song = '$song'";
    if($stmt = mysqli_prepare($conn, $sql)){
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 0){
				$sql = "INSERT INTO `ratings`  VALUES ('0', '$username', '$artist', '$song', '$rating')";
				$result = mysqli_query($conn, $sql);
				
				if($result)
				{
					echo "Contact Records Inserted";
					header("location: reviewboard.php");
					exit();
				}
            } else{               
                $input_error = "You've already input this song our system! Try editing it, or deleting it and then posting it again."; echo $input_error;   
                            }
        } else{
            echo "Uh oh, it seems sql wasn't able to execute the statement? Perhaps try again.";
        }
    }
    mysqli_stmt_close($stmt);
}



?>
<!DOCTYPE html>
<html>
<head> 	<title> Review a song!</title>	 </head>

<body> 		<legend>		<h2>Thank you for your valuable opinion! :D</h2>	</legend>
<form name="frmContact" method="post" action="reviewboard.php">

<p> <input type="submit" name="You're welcome! Take me back to the music board" id="Submit" value="Okay, take me back to the homepage"> </p>		</form>		</body>
</html>