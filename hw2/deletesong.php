<?php

// create connection
include_once "config.php";

//welcome user to page, display logged in user
session_start();

echo 'Greetings ' . $_SESSION['username'] . '! Are you sure you would like to delete the review below? We promise your opinion was not so bad. <br \> <br \>';
echo ('Currently logged in as: <b>' . $_SESSION['username'] . '</b><br \>');
echo ('<br \><br \>');

// check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  ?>

<html>
<head> 	
    <title> Deleting! </title>	 
</head>
<body> 		

<form name="deleteSongForm" method="POST" action="deletesongpost.php">      
    <!-- form displaying information about song to be deleted. cannot be edited. only has a confirm button-->
    <table>
        <tr><td>Id: </td><td><?php echo $_GET['id'];?></td></tr>
        <?php
        $id = $_GET['id'];
        $query = "SELECT * FROM ratings WHERE id=$id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        echo"<tr><td>Username: </td><td>".htmlspecialchars($row['username'])."</td></tr>";
        echo"<tr><td>Artist: </td><td>" . htmlspecialchars($row['artist']) . "<br></td></tr>";
        echo"<tr><td>Song: </td><td>".  htmlspecialchars($row['song']) . "<br></td></tr>";
        echo"<tr><td>Rating: </td><td>" . htmlspecialchars($row['rating']) . "<br></td></tr>";
        echo"<input type='hidden' value='$id' name='id' />";
        echo"<input type='hidden' value=" . htmlspecialchars($row['username']) . " name='username' />";
        ?>

    </table>

    <input type="submit" name="delete" value="Confirm Delete"/>
</form>
	
<!-- cancel deletion, return to reviewboard.php -->
<form name="frmContact" method="get" action="reviewboard.php">   
<p> 
    <input type="submit" name="redirect_button" id="Submit" value="Click here to cancel the deletion, or to simply return to the ratings page!"> 
</p>
</form>		

</body>
</html>
