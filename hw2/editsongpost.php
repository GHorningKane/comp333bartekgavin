<?php
    //establish connection
    require_once "config.php";

    //check conn
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $rating = trim($_POST['rating']);

    if ($rating < 1 || $rating > 5) {   //if input not in expected range, error
        echo  "Rating must be in the range of 0 < x < 5 <br>"; 
    } else {        //else
        if (isset($_REQUEST["submit"])) {
            $out_value = "";
            $id = $_REQUEST['id'];
            $username = $_REQUEST['username'];
            $artist = $_REQUEST['artist'];
            $song = $_REQUEST['song'];
            $rating = $_REQUEST['rating'];
      
          $sql = "UPDATE ratings SET artist=?, song=?, rating=? WHERE id=?";        //else update that row with a parameterized query.
          if($stmt = mysqli_prepare($conn, $sql)){
              mysqli_stmt_bind_param($stmt, "ssii", $artist, $song, $rating, $id);
              if(mysqli_stmt_execute($stmt)){
                  header("location: reviewboard.php");
              } else{
                  echo "Uh oh, it seems there was a failure, Please debug me";
              }
          }
        //   mysqli_stmt_close($stmt);
          }
    }
    $conn->close();
?>

<html>
<a href = reviewboard.php target="_new" id = "shmerp"> Oops, take me back to the reviewboard</a> <br>

</html>