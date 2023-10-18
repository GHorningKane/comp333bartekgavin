  <?php
    require_once "config.php";

    // Create server connection.
    // The MySQLi Extension (MySQL Improved) is a relational database driver 
    // used in the PHP scripting language to provide an interface with MySQL 
    // databases (https://en.wikipedia.org/wiki/MySQLi).
    // Instances of classes are created using `new`.
    $connection = new mysqli($servername, $usernamedb, $passworddb, $dbname);
    $error = "";

    // Check server connection.
    // -> is used to call a method or access a property instance of a class,
    // in our case the connection $conn we created calls the built in connect_error
    // method available to all connections.
    // Note the difference to =>, which is used for arrow functions, a more 
    // concise syntax for anonymous functions (which we will also see in JavaScript).
    // See https://stackoverflow.com/questions/14037290/what-does-this-mean-in-php-or/14037320.
    if ($connection->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // `isset` — Function to determine if a variable is declared and is different than null.
    // Generally, check out the PHP documentation. It is really good and has
    // use examples, e.g., https://www.php.net/manual/en/function.isset.php
    // $_REQUEST is a PHP built-in superglobal variable which is used to collect data 
    // after submitting an HTML form.
    // https://www.w3schools.com/PHP/php_superglobals_request.asp
    // Some predefined variables in PHP are superglobals, which means that 
    // they are always accessible, regardless of scope - and you can access them 
    // from any function, class or file without having to do anything special.
    // https://www.w3schools.com/PHP/php_superglobals.asp
    if (isset($_REQUEST["submit"])) {
      // Variables for the output and the web form below.
      $out_value = "";
      $username = $_REQUEST['username'];
      $password = $_REQUEST['password'];
  
      // Check that the user entered data in the form.
      if (!empty($username) && !empty($password)) {
          // Create a prepared statement to select data using parameters.
          $sql_query = "SELECT * FROM users WHERE username = ?";
          $stmt = $connection->prepare($sql_query);
  
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
      $connection->close();
  }


