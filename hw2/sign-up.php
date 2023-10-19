<?php
require_once "config.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$password_check = trim($_POST['password_check']);
$input_error = "";      //gather vars from user, input is non-empty if an error has occured.

if(empty($password_check)){ $input_error = "Password confirm empty<br>"; echo $input_error;  }
if(empty($password)){    $input_error = "Password empty<br>"; echo $input_error;} 
if(strlen($password) < 10) { $input_error = "Password must be at least 10 characters long<br>"; echo $input_error;}
if(!preg_match("/[0-9]/", $password)) {$input_error = "Password must contain at least 1 number<br>"; echo $input_error;}
if(empty($input_error) && ($password != $password_check)){            $input_error = "Password don't match<br>"; echo $input_error;        }  
$password = password_hash($password, PASSWORD_DEFAULT);     // have to do this after I compare password and confirm password I guess haha?

if(empty($username)){
    $input_error = "Username empty";
    echo $input_error;   

} else{
    $sql = "SELECT username FROM users WHERE username = ?";
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $username);
        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 0){
                                    $username = $username;
            } else{               
                $input_error = "Username taken.";   echo $input_error;   
                            }
        } else{
            echo "Uh oh, it seems sql wasn't able to execute the statement? Perhaps try again.";
        }
    }
    mysqli_stmt_close($stmt);
}

if(empty($input_error)){
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        if(mysqli_stmt_execute($stmt)){
            header("location: login.html");
        } else{
            echo "Uh oh, it seems sql wasn't able to execute the statement? Perhaps try again.";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>





