<?php

function load_profile ($mysqli, $username)
{
	/**/
	$db_query = "
	SELECT  	
		first_name, 
		last_name, 
		bio, 
		experience, 
		c.skill_name 
	FROM usr_db as a 
	LEFT JOIN user_skills as b
	ON a.user_id = b.user_id
	LEFT JOIN skills as c 
	ON c.skill_id = b.skill_id
	WHERE username = '".$username."'";
/*
	//prepared statement
	if (!($stmt = $mysqli->prepare($db_query))) 
	{
		echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
	}
	//BIND VARIABLES TO BE INSERTED INTO TABLE
	if (!$stmt->bind_param("sssss", $fname, $lname, $bio, $experience, $skills)) {
		echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}
	//EXECUTE
	if (!$stmt->execute()) {
		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
	}
*/

	$result= $mysqli->query($db_query);

	$row = mysqli_fetch_array($result);
	
	$fname = $row['first_name'];
	$lname = $row['last_name'];
	$bio = $row['bio'];

	$experience = $row['experience'];
	$skills = $row['skill_name'];

	$name_f = "<h1>".$fname." ".$lname."</h1>";
	$bio_f = "<p class=lead>BIO</p><p>".$bio."</p>";
	$experience_f = "<p class=lead>EXPERIENCE</p><p>".$experience."</p>";
	$skills_f = "<p class=lead>SKILLS</p><p>".$skills."</p>";
	$outputString = $name_f.$bio_f.$experience_f.$skills_f;
	//wrap outputString
	$outputString = "<div class='well'>".$outputString."</div>";

	return $outputString;
}

//temp for testing

//CONNECT
/*
$mypassword = "RdNAmTfkrFADuWx1";
		$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "osterbit-db", $mypassword, "osterbit-db");
		if ($mysqli->connect_errno) {
			echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		}
		else {
			echo "connected";
		}


$testUser = "sampleuser1";
$html_str = load_profile ($mysqli, $testUser);
echo $html_str;
*/
?>




