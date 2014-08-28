<?php
ini_set('display_errors', 'On');
session_start();
require "db_connect.php";

if (array_key_exists("fname", $_POST)
	&& array_key_exists("lname", $_POST)
	&& array_key_exists("email", $_POST)
	&& array_key_exists("username", $_POST)
	&& array_key_exists("password", $_POST)
	) 
{
	$first_name = mysqli_real_escape_string( $mysqli, $_POST['fname']);
	$last_name = mysqli_real_escape_string( $mysqli, $_POST['lname']);
	$email = mysqli_real_escape_string( $mysqli, $_POST['email']);
	$username = mysqli_real_escape_string( $mysqli, $_POST['username']);
	$password = mysqli_real_escape_string( $mysqli, $_POST['password']);

	//validate input
	if (strlen($username) < 4)
		echo "<pre>username too short</pre>";
	else if (strlen($password) < 4)
		echo "<pre>password too short</pre>";
	/*
	else if (!(userName_available($username, $mysqli)))
		echo "<pre>username already taken</pre>";
	*/
	else {
		//attemp to add to database
		//prepare
		$create_query = "
		INSERT INTO usr_db(
			username, 
			pass, 
			first_name, 
			last_name, 
			email_address)
		VALUES (?, ?, ?, ?, ?)
		";
		if (!($stmt = $mysqli->prepare($create_query))) { echo "Falied to prepare query (".$mysqli->connect_errno.") ".$mysqli->connect_error;}
		if (!($stmt->bind_param('sssss', $username, $password, $first_name, $last_name, $email))) {echo "<script>alert('failed to bind parameters')</script>";}
		if (!$stmt->execute()) {echo "Falied to execute query (".$mysqli->connect_errno.") ".$mysqli->connect_error;}

		//set session username and logged in status
		$_SESSION['username'] = $username;
		$_SESSION['logged_in_status'] = 1;
		//go to landing page
		echo "1";

	}
}
else 
	echo "<pre>didn't work</pre>";

function userName_available($test_name, $mysqli){
	/*
	$results = mysqli_query($mysqli,"SELECT username FROM usr_db WHERE username='".$test_name."'");
	$username_exist = mysqli_num_rows($results); //number of rows returned from the query
	if (!$username_exist)
		return 1;
	else
		return 0;
	*/
	//if ($mysqli->connect_errno){ echo "<script>alert('Failed to connect to MySQL (".$mysqli->connect_errno.") ".$mysqli->connect_error."')</script>";}
	$dbquery= "SELECT username FROM usr_db WHERE username='".$test_name."'";
	//db query: prepare->execute->bind->evaluate
	//prepare
	if (!($stmt = $mysqli->prepare($dbquery))) { echo "Falied to prepare query (".$mysqli->connect_errno.") ".$mysqli->connect_error;}
	//execute
	if (!$stmt->execute()) {echo "Falied to execute query (".$mysqli->connect_errno.") ".$mysqli->connect_error;}
	//bind
	$db_usr = NULL;
	if (!($stmt->bind_result($db_usr))) {echo "Falied to bind parameters (".$mysqli->connect_errno.") </p>".$mysqli->connect_error;}
	//evaluate
	$result=0;
	$db_temp = NULL;
	while ($stmt->fetch()) {
		$result += 1;
		$db_temp = $db_usr;
	}
	$stmt->close();
	if ($db_temp) {
		return 0;
	}
	else 
		return 1;
}

?>