<?php
session_start();
echo 'Greetings ' . $_SESSION['username'] . '! Are you sure you would like to delete the review below? We promise your opinion was not so bad. <br \> <br \>';
echo ('Currently logged in as: ' . $_SESSION['username'] . '<br \>');
echo ('<br \><br \>');
?>