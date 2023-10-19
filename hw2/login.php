  <?php

    //establish connection
    require_once "config.php";

    //check conn
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_REQUEST["submit"])) {
      // Variables from login.html.
      $username = $_REQUEST['username'];
      $password = $_REQUEST['password'];
  
      // Check that the user entered data in the form.
      if (!empty($username) && !empty($password)) {
          // Create a prepared statement to select data using parameters.
          $sql_query = "SELECT * FROM users WHERE username = ?";
          $stmt = $conn->prepare($sql_query);
  
          // Bind the parameter and execute the statement.
          $stmt->bind_param("s", $username);
          $stmt->execute();
  
          // Get the result and fetch the data.
          $result = $stmt->get_result();
          $row = $result->fetch_assoc();
  
          if (!$row) {
              echo "Username doesn't exist :/";
          } else {
              if (password_verify($password, $row['password'])) {
                  session_start();
                  echo('PHPSESSID: ' . session_id($_GET['session_id']));
                  $_SESSION['username'] = $username;
                  $_SESSION["loggedin"] = true;
                  header("location: reviewboard.php");
              } else {
                  $error = "Passwords do not match :/";
                  echo $error;
              }
          }
          // Close the prepared statement.
          $stmt->close();
      }
      // Close SQL connection.
      $conn->close();
  }


