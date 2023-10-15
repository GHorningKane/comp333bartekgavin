<?php

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
