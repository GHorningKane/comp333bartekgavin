<?php
// logout functionality
$_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
// Finally, destroy the session.
session_destroy();
?>
<html>

<head> 	 The Logout was Successful!	 </head>

<!-- <legend>		<p>HTML for logout</p>	</legend> -->
<body> 		
    <!-- <legend>		<p>Would you like to add a new song?</p>	</legend> -->
<form name="frmContact" method="post" action="login.html">

<p> <input type="submit" name="redirect_button" id="Submit" value="Click Here to Return Login!"> </p>		</form>		</body>

</html>