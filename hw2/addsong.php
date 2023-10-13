<?php

$con = mysqli_connect("localhost","root","","music_db");

$username = $_POST['username'];
$artist = $_POST['artist'];
$song = $_POST['song'];
$rating = $_POST['rating'];

$sql = "INSERT INTO `ratings`  VALUES ('0', '$username', '$artist', '$song', '$rating')";

$rs = mysqli_query($con, $sql);

if($rs)
{
	echo "Contact Records Inserted";
}

?>
<!DOCTYPE html>
<html>
<head> 	<title> Review a song!</title>	 </head>

<body> 		<legend>		<h2>Thank you for your valuable opinion! :D</h2>	</legend>
<form name="frmContact" method="post" action="reviewboard.php">

<p> <input type="submit" name="You're welcome! Take me back to the music board" id="Submit" value="Submit"> </p>		</form>		</body>
</html>

