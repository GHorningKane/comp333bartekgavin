<?php
session_start();

echo 'Greetings ' . $_SESSION['username'] . '! Let us know how your rating of the song shown below has changed. Or alternatively, feel free to otherwise change the artist or song. <br \> <br \>';
echo ('Currently logged in as: <b>' . $_SESSION['username'] . '</b><br \>');
echo ('<br \><br \>');

// create connection
$conn = mysqli_connect('localhost', 'root', '', 'music_db');

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

// update line to be edited to include specific ID of which is being edited
// $sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

// if ($conn->query($sql) === TRUE) {
//     echo "Record updated successfully";
//     sleep(6);
//     header("Location: reviewboard.php")
//     // need  a REDIRECT TO ANOTHER PAGE HERE or maybe not???
//   } else {
//     echo "Error updating record: " . $conn->error;
//   }
  
$conn->close();
?>

<html>
<head> 	
    <title> Editing! </title>	 
</head>
<body> 		
    <!-- <legend>		<p>HTML button for returning to ratings list before/after update </p>	</legend> -->
    <!-- <legend>		<p>Click here to cancel the update, or to simply return to the ratings page!</p>	</legend> -->

<form name="editSongForm" method="POST" action="editsongpost.php">
    <table>
        <tr><td>Id: </td><td><?php echo $_GET['id'];?></td></tr>

        <?php
        $id = $_GET['id'];
        $connection = mysqli_connect('localhost', 'root', '', 'music_db');
        $query = "SELECT * FROM ratings WHERE id=$id";  // TODO: make this paramaterized to avoid SQL injection attacks pls
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($result);
        echo"<tr><td>Username: </td><td>".htmlspecialchars($row['username'])."</td></tr>";
        echo"<tr><td>Artist: </td><td><input type='text' name='artist' placeholder='Artist' value='" . htmlspecialchars($row['artist']) . "'/><br></td></tr>";
        echo"<tr><td>Song: </td><td><input type='text' name='song' placeholder='Song' value='" . htmlspecialchars($row['song']) . "'/><br></td></tr>";
        echo"<tr><td>Rating: </td><td><input type='text' name='rating' placeholder='Rating' value='" . htmlspecialchars($row['rating']) . "'/><br></td></tr>";
        echo"<input type='hidden' value='$id' name='id' />";
        echo"<input type='hidden' value=" . htmlspecialchars($row['username']) . " name='username' />";
        ?>

    </table>
    <input type="submit" name="submit" value="Submit"/>
</form>
	
<!-- <legend>		<p>Return to ratings page?</p>	</legend> -->
<form name="frmContact" method="get" action="reviewboard.php">   
<p> 
    <input type="submit" name="redirect_button" id="Submit" value="Click here to cancel the update, or to simply return to the ratings page!"> 
</p>
</form>		

</body>
</html>
