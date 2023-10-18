<?php

session_start();
echo 'Greetings ' . $_SESSION['username'] . '! Welcome to the music review board! :D <br \> <br \>';
echo ('Currently logged in as: ' . $_SESSION['username'] . '<br \>');
echo ('<br \>');


$connection = mysqli_connect('localhost', 'root', '', 'music_db');

$query = "SELECT * FROM ratings"; 
$result = mysqli_query($connection, $query);

echo "<table>"; 

while($row = mysqli_fetch_array($result)){   
echo "<tr>
<td>" . htmlspecialchars($row['username']) . " </td>
<td>"     . htmlspecialchars($row['artist']) . "</td>
<td>"     . htmlspecialchars($row['song']) . "</td>
<td>"     . htmlspecialchars($row['rating']) . "</td>
</tr>";  
}

echo "</table>"; 



$connection -> close();


?>

<html>
<head> 	<title> The Review Board!</title>	 </head>

<body> 		
    <!-- <legend>		<p>Would you like to add a new song?</p>	</legend> -->
<form name="frmContact" method="post" action="addsong.php">

<p> <input type="submit" name="redirect_button" id="Submit" value="Add new song"> </p>		</form>		</body>

<body> 		
    <!-- <legend>		<p>Would you like to edit a review for an existing song that you've posted?</p>	</legend> -->
<form name="frmContact" method="post" action="editsong.php">

<p> <input type="submit" name="redirect_button" id="Submit" value="Edit an existing song"> </p>		</form>		</body>

<body> 		
    <!-- <legend>		<h2>Would you like to delete a review for an existing song that you've posted?</h2>	</legend> -->
<form name="frmContact" method="post" action="deletesong.php">

<p> <input type="submit" name="redirect_button" id="Submit" value="Delete an existing song"> </p>		</form>		</body>

<!-- <legend>		<p>HTML for logout</p>	</legend> -->
<body> 		
    <!-- <legend>		<p>Would you like to add a new song?</p>	</legend> -->
<form name="frmContact" method="post" action="logout.php">

<p> <input type="submit" name="redirect_button" id="Submit" value="Click Here to Logout!"> </p>		</form>		</body>

</html>