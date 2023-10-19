<html>
    
<head> 	
    <title> The Review Board!</title>	 
    <style>
        <?php include '../style-sheet.css'; ?>
    </style>
</head>

<?php

require_once "config.php";

session_start();
echo 'Greetings ' . $_SESSION['username'] . '! Welcome to the music review board! :D <br \> <br \>';
echo ('Currently logged in as: ' . $_SESSION['username']);
echo ('<br \>');

?>

<body> 		


<form name="frmContact" method="post" action="addsong.php">

<p> <input type="submit" name="redirect_button" id="Submit" value="Add new song"> </p>		</form>		</body>

<body> 		
<form name="frmContact" method="post" action="logout.php">

<p> <input type="submit" name="redirect_button" id="Submit" value="Click Here to Logout!"> </p>		</form>		</body>

<?php

$query = "SELECT * FROM ratings"; 
$result = mysqli_query($conn, $query);

echo "<table>"; 
echo "<tr>
<td><b>ID</b></td>
<td><b>Username</b></td>
<td><b>Artist</b></td>
<td><b>Song</b></td>
<td><b>Rating</b></td>
</tr>";  
while($row = mysqli_fetch_array($result)){   
echo "<tr>
<td>" . htmlspecialchars($row['id']) . " </td>
<td>" . htmlspecialchars($row['username']) . " </td>
<td>"     . htmlspecialchars($row['artist']) . "</td>
<td>"     . htmlspecialchars($row['song']) . "</td>
<td>"     . htmlspecialchars($row['rating']) . "</td>
"; 
if($row['username'] == $_SESSION['username']) {
    echo "
    <td><a href='editsong.php?id=" . htmlspecialchars($row['id']) . "'>Edit</a></td>
    <td><a href='deletesong.php?id=" . htmlspecialchars($row['id']) . "'>Delete</a></td> 
    ";
}
echo "</tr>";  
}
echo "</table>"; 
$conn -> close();
?>

</html>
