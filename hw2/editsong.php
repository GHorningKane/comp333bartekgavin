<?php
session_start();

echo 'Greetings ' . $_SESSION['username'] . '! Let us know how your rating of the song shown below has changed. Or alternatively, feel free to otherwise change the artist or song. <br \> <br \>';
echo ('Currently logged in as: ' . $_SESSION['username'] . '<br \>');
echo ('<br \><br \>');

// create connection
$connection = mysqli_connect('localhost', 'root', '', 'music_db');

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

// update line to be edited to include specific ID of which is being edited
$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
    sleep(6);
    header("Location: reviewboard.php")
    // need  a REDIRECT TO ANOTHER PAGE HERE or maybe not???
  } else {
    echo "Error updating record: " . $conn->error;
  }
  
$conn->close();
?>

<html>
<head> 	<title> Editing! </title>	 </head>
<!-- <legend>		<p>HTML button for returning to ratings list before/after update </p>	</legend> -->
<body> 		
    <!-- <legend>		<p>Click here to cancel the update, or to simply return to the ratings page!</p>	</legend> -->
<form name="frmContact" method="post" action="reviewboard.php">

<p> <input type="submit" name="redirect_button" id="Submit" value="Click here to cancel the update, or to simply return to the ratings page!"> </p>		</form>		</body>

</html>