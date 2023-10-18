<?php
session_start();
echo 'Greetings ' . $_SESSION['username'] . '! Let us know how your rating of the song shown below has changed. <br \> <br \>';
echo ('Currently logged in as: ' . $_SESSION['username'] . '<br \>');
echo ('<br \><br \>');
?>