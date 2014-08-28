<?php
ini_set('display_errors', 'On');
session_start();
require "./db_connect.php";

if (array_key_exists("username", $_POST) &&
    array_key_exists("password", $_POST)) 
{
  if (isset($_POST['username']) && isset($_POST['password'])) {
    echo processLogin($_POST['username'], $_POST['password'], $mysqli);
  }

} else 
{
  echo "didnt work<br>";
}

function processLogin($input_usr, $input_pwd, $mysqli) {
	$retval = NULL;
	$result = 0;

	$username_clean = mysqli_real_escape_string ( $mysqli, $input_usr);
	$password_clean = mysqli_real_escape_string ( $mysqli, $input_pwd);

	$dbquery = "
		SELECT username, first_name, last_name, email_address
		FROM usr_db
		WHERE username='".$username_clean."' 
  		AND pass='".$password_clean."'";
		//prepare
		if (!($stmt = $mysqli->prepare($dbquery))) {echo "Falied to prepare query (".$mysqli->connect_errno.") ".$mysqli->connect_error; }
		//execute
		if (!$stmt->execute()) { echo "Falied to execute query (".$mysqli->connect_errno.") ".$mysqli->connect_error; }
		//bind
		if (!($stmt->bind_result($db_usr, $db_fname, $db_lname, $db_email))) { echo "Falied to bind parameters (".$mysqli->connect_errno.") </p>".$mysqli->connect_error;
		}
		//evaluate
		$result = 0;
		while($stmt->fetch()) {
			$result += 1;
		}
		if ($result == 1)
		{
			$retval = 1;
			$_SESSION['username'] = $db_usr;
			$_SESSION['first_name'] = $db_fname;
			$_SESSION['last_name'] = $db_lname;
			$_SESSION['email'] = $db_email;
			$_SESSION['logged_in_status'] = 1;
		}
		else $retval = NULL;
		$stmt->close();

	return $retval;
}

?>