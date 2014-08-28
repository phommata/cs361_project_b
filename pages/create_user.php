<?php 
		session_start();
		ini_set('display_errors', 'On');//errors on
		include 'db_connect.php';//db password
		
		$username = isset($_POST["username"])?$_POST["username"]:"";
		$password = isset($_POST["password"])?$_POST["password"]:"";
		$fname = isset($_POST["fname"])?$_POST["fname"]:"";
		$lname = isset($_POST["lname"])?$_POST["lname"]:"";
		$email = isset($_POST["email"])?$_POST["email"]:"";
		
		//CONNECT
		/*
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "krullj-db", $mypassword, "krullj-db");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}*/
		
		//ADDED BELOW
		//check username in the database to see if it exists
	  $results = mysqli_query($mysqli,"SELECT username FROM usr_db WHERE username='$username'");
	  $username_exist = mysqli_num_rows($results); //number of rows returned from the query
	  
	  //if returned value is more than 0, username is not available
	  if($username_exist) {
		  echo "The username ".$username." already exists.";
	  }
	  else {
				//PREPARE THE STATEMENT TO ENTER INFO INTO TABLE
		if (!($stmt = $mysqli->prepare("INSERT INTO usr_db(username, pass, first_name, last_name, email_address) VALUES (?, ?, ?, ?, ?)"))) {
			echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		//BIND VARIABLES TO BE INSERTED INTO TABLE
		if (!$stmt->bind_param("sssss", $username, $password, $fname, $lname, $email)) {
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		//EXECUTE
		if (!$stmt->execute()) {
			echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
		}
		
		$_SESSION['username'] = $username;
		//$_SESSION['password'] = $password;
		?>
			Account successfully created! <input type="button" onclick="profileGo();" value="Go to Profile">
			<script>
			function profileGo() {
				window.location.href = "profile_page.php";
			}
			</script>
			
		<?php
	  }
	?>