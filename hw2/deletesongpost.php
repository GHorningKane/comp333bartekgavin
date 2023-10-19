<?php
session_start();
echo 'Greetings ' . $_SESSION['username'] . '! Are you sure you would like to delete the review below? We promise your opinion was not so bad. <br \> <br \>';
echo ('Currently logged in as: ' . $_SESSION['username'] . '<br \>');
echo ('<br \><br \>');

    require_once "config.php";


    $connection = new mysqli($servername, $usernamedb, $passworddb, $dbname);
    $error = "";

    if ($connection->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    
    // if (isset($_REQUEST["submit"])) {
    //   $out_value = "";
      $id = $_REQUEST['id'];
    //   $username = $_REQUEST['username'];
    //   $artist = $_REQUEST['artist'];
    //   $song = $_REQUEST['song'];
    //   $rating = $_REQUEST['rating'];

      echo $id;
    //   echo $username;
    //   echo $artist;
    //   echo $song;
    //   echo $rating;

    // $sql = "DELETE FROM ratings WHERE id=?";
    if (isset($_POST['delete'])) {
        // PHP code to be executed when the button is pressed
        // $sql = ALTER TABLE ratings DROP INDEX id = $id;
        echo"here0";
        $sql = "DELETE FROM ratings WHERE id = ?";
        if ($stmt = mysqli_prepare($connection, $sql)) {
            echo"here";
            mysqli_stmt_bind_param($stmt, "i", $id);
        //     // echo"here1.5";
            if(mysqli_stmt_execute($stmt)){
                // echo"here1";
                // return to reviewboard after deletion!
                header("location: reviewboard.php");
            } else{
                // echo"here2";
                echo "Uh oh, it seems there was a failure, Please debug me";
            }
            mysqli_stmt_close($stmt);
        }

        header("location: reviewboard.php");
    }
    $connection->close();
?>