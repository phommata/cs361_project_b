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

function fill_edit_experience ($mysqli, $username)
{
	$db_query = "
	SELECT experience
	FROM usr_db
	WHERE username = '".$username."'";

	$result= $mysqli->query($db_query);

	$row = mysqli_fetch_array($result);
	
	$experience = $row['experience'];
	
	return $experience;
}

function fill_edit_bio ($mysqli, $username)
{
	$db_query = "
	SELECT bio
	FROM usr_db
	WHERE username = '".$username."'";

	$result= $mysqli->query($db_query);

	$row = mysqli_fetch_array($result);
	
	$bio = $row['bio'];
	
	return $bio;
}

?>




