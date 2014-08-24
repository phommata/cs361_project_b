<?php
	ini_set('display_errors', 'On');
	session_start();
	if(isset($_SESSION['loggedinstatus'])) {
		if($_SESSION['loggedinstatus']){
			header('location: ./homepage.php')
		}
	}
	
	function add_user($username, $password, $fname, $lname, $email, $mysqli) {
		$dbquery = "INSERT INTO usr_db (username, pass, first_name, last_name, email_address) VALUES (".$username.",".$password.",".$fname.",".$lname.",".$email.")";
		$_SESSION['username'] = $username;
		
		//prepare
		if(!($stmt = $mysqli->prepare($dbquery))) {
			echo "Failed to prepare query";
		}
		//execute
		if(!$stmt->execute()){
			echo "Failed to execute";
		}
		
	}
	
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "krullj-db", $mypassword, "krullj-db");
	if(!$mysqli || $mysqli->connect_errno) {
		echo "failed to connect";
	}
	
	/*
		page reloaded when submit
		check for existence of posted fields
		if each exist: proceed
		else: display error to check your fields
	*/	
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email'])) {
	//create php variables from post array
		$username = $_POST['username'];
		$password = $_POST['password'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		//make sure to incorporate validation/sanitation
		
	//prepared statements with username to check if there is a match for the username, if > 0 proceed
		$dbquery = "SELECT username FROM usr_db WHERE username = '".$username."'";
		//prepare
		if(!($stmt = $mysqli->prepare($dbquery))) {
			echo "Failed to prepare query";
		}
		//execute
		if(!$stmt->execute()){
			echo "Failed to execute";
		}
		
		$result = 0;
		while($stmt->fetch()) {
			$result += 1;
		}
		
		if($result > 0) {
			echo "Username is already in use";
		}
		else {
			add_user($username, $password, $fname, $lname, $email, $mysqli);
		}
	}
	else {
		//do something
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create an account</title>

	<link rel="stylesheet" href="stylesheets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="stylesheets/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="stylesheets/bootstrap/css/docs.min.css">
	

</head>
<body>
<div class="container">
	<h1 class="pageHeader">Create a new account</h1>
        <p id="message">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia aliquid perspiciatis commodi rerum quisquam consequatur vero laborum repudiandae similique facere quod pariatur maiores, blanditiis veniam cum soluta id doloribus, facilis.</p>
	<form action="signup.php" method="POST">
			<legend>Enter account information</legend>
			<p>Choose a username and password</p>
			<div class="form-group">
				<input 	type="text" 
						class="form-control" 
						placeholder="username" 
						id="username"
						name="username">
				<input type="password"
						class="form-control"
						placeholder="password"
						id="psswd"
						name="psswd">
			<p><br>Please provide your first and last name</p>
 				<input type="text"
						class="form-control"
						placeholder="first name"
						id="fname"
						name="fname">
	 			<input type="text"
						class="form-control"
						placeholder="last name"
						id="lname"
						name="lname">
				<input type="email"
						class="form-control"
						placeholder="email"
						id="email"
						name="email">
			</div>
			<button class="btn btn-primary" type="submit">signup</button>
	</form>
<?php


?>

</div>

<script src="stylesheets/bootstrap/js/jquery-1.11.0.min.js"></script>
<script src="stylesheets/bootstrap/js/bootstrap.min.js"></script>	
</body>
</html>