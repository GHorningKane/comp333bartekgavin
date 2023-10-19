<?php
//welcome user to page, display logged in user
session_start();
echo 'Greetings ' . $_SESSION['username'] . '! Are you sure you would like to delete the review below? We promise your opinion was not so bad. <br \> <br \>';
echo ('Currently logged in as: ' . $_SESSION['username'] . '<br \>');
echo ('<br \><br \>');

    //establish and check connection
    require_once "config.php";

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

      $id = $_REQUEST['id'];

    if (isset($_POST['delete'])) {
        // PHP code to be executed when the button is pressed
        $sql = "DELETE FROM ratings WHERE id = ?";    //delete the row from the table, parameterized of course
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            if(mysqli_stmt_execute($stmt)){
                header("location: reviewboard.php");
            } else{
                echo "Uh oh, it seems there was a failure, Please debug me";
            }
            mysqli_stmt_close($stmt);
        }
        header("location: reviewboard.php");  //when done, return to review board
    }
    $conn->close();

?>

