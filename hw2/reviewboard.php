<?php

session_start();
echo 'Greetings! Welcome to the music review board! :D <br \> <br \>';
// echo ('Currently logged in as: ' . session_id($_GET['username']) . '<br \>');
echo ('Currently logged in as: ' . $_SESSION['username'] . '<br \>');
echo ('<br \><br \>');


$connection = mysqli_connect('localhost', 'root', '', 'music_db');

$query = "SELECT * FROM ratings"; 
$result = mysqli_query($connection, $query);

echo "<table>"; 

while($row = mysqli_fetch_array($result)){   
echo "<tr>
<td>" . htmlspecialchars($row['username']) . "</td>
<td>"     . htmlspecialchars($row['artist']) . "</td>
<td>"     . htmlspecialchars($row['song']) . "</td>
<td>"     . htmlspecialchars($row['rating']) . "</td>
</tr>";  
}

echo "</table>"; 

$connection -> close();


?>
