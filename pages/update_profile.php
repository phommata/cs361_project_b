<?php
require "./db_connect.php";
require "./profile_page_functions.php";
$usr = "sampleuser1"; //NEEDS TO BE UPDATED TO SESSION!!!!!!!
	
	$experience = isset($_POST["experience"])?$_POST["experience"]:"";
	$bio = isset($_POST["bio"])?$_POST["bio"]:"";

	//PREPARE THE STATEMENT TO ENTER INFO INTO TABLE
	if (!($stmt = $mysqli->prepare("UPDATE usr_db SET experience = ?, bio = ? WHERE username = ?"))) {
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	//BIND VARIABLES TO BE INSERTED INTO TABLE
	if (!$stmt->bind_param("sss", $experience, $bio, $usr)) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	//EXECUTE
	if (!$stmt->execute()) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	else {
		echo "<html><head><title>Success!</title></head><body> <p> Success!</p> </body> </html>";
	}
	
?>