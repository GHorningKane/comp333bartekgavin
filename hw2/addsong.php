<!DOCTYPE html>
<html>
<head> <title> Review a song!</title> </head>

<?php
//welcome user to page, display logged in user
session_start();
echo 'Greetings ' . $_SESSION['username'] . '! Tell us about the song you would like to review! :D <br \> <br \>';
echo ('Currently logged in as: ' . $_SESSION['username'] . '<br \>');
echo ('<br \><br \>');
?>

<body>
<form name="frmContact" method="post" action="addsong2.php">

<!--Input fields for user to enter information-->
<p> <label for="Artist">Artist</label>
<input type="text" name="artist" id="artist" placeholder="Artist name"> </p>

<p> <label for="Song">Song</label>
<input type="text" name="song" id="song" placeholder="Song title"></p>

<p> <label for="Rating">Rating</label>
<textarea name="rating" id="rating" placeholder = "Number 1-5"></textarea> </p>

<!--to send to other addsong2 code-->
<p>
<input type="submit" name="Submit" id="Submit" value="Submit">
</p>
</form>
</body>
</html>