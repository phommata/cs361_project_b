<?php
	ini_set('display_errors', 'On');//errors on
	include 'db_connect.php';//db password
	
	if(isset($_POST["username"]))
	{
		//CONNECT
		/*
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "krullj-db", $mypassword, "krullj-db");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		*/
	  
	  //received username value from registration page
	  $username =  $_POST["username"]; 

	  //check username in database
	  $results = mysqli_query($mysqli,"SELECT username FROM usr_db WHERE username='$username'");
	  
	  $username_exist = mysqli_num_rows($results); //number of rows returned from the query
	  
	  //if returned value is more than 0, username is not available
	  if($username_exist) {
		  echo "The username ".$username." already exists.";
	  }/*else{
		
	  }*/
	}
?>