<?php
    require_once "config.php";


    $connection = new mysqli($servername, $usernamedb, $passworddb, $dbname);
    $error = "";

    if ($connection->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    // need help on making this function properly!!!
    $rating = trim($_POST['rating']);
    // $rating = $_POST['rating'];
    // echo gettype($rating) . "<br>";
    if ($rating < 1 || $rating > 5) { 
        $input_error = "Rating must be in the range of 0 < x < 5 <br>"; 
        echo $input_error;
    } else {
        if (isset($_REQUEST["submit"])) {
            $out_value = "";
            $id = $_REQUEST['id'];
            $username = $_REQUEST['username'];
            $artist = $_REQUEST['artist'];
            $song = $_REQUEST['song'];
            $rating = $_REQUEST['rating'];
      
            echo $id;
            echo $username;
            echo $artist;
            echo $song;
            echo $rating;
      
          $sql = "UPDATE ratings SET artist=?, song=?, rating=? WHERE id=?";
          if($stmt = mysqli_prepare($connection, $sql)){
              echo"here";
              mysqli_stmt_bind_param($stmt, "ssii", $artist, $song, $rating, $id);
              // echo"here1.5";
              if(mysqli_stmt_execute($stmt)){
                  // echo"here1";
                  // return to reviewboard after updating!
                  header("location: reviewboard.php");
              } else{
                  // echo"here2";
                  echo "Uh oh, it seems there was a failure, Please debug me";
              }
          }
          mysqli_stmt_close($stmt);
      
          }
    }
    
    $connection->close();
?>

