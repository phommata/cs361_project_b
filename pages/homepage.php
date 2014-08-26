<?php
// 	session_start();
	//Turn on error reporting
	ini_set('display_errors', 'On');
	//Connects to the database
	$mysqli = new mysqli("oniddb.cws.oregonstate.edu","phommata-db","Lm0QgLxFUbJHtq2D","phommata-db");
	if($mysqli->connect_errno){
		echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<link rel="stylesheet" href="stylesheets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="stylesheets/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="stylesheets/bootstrap/css/docs.min.css">
<body>
<div class="container">
	<h1 class="pageHeader">User's Homepage</br></br></h1>
	<table>
		<tr>
			<td>Job Name</td>
			<td>Job Emp</td>
			<td>Job Desc</td>
			<td>Job Pay</td>
			<td>Skill Name</td>
		</tr>
		<div>
			<form method="post" action="homepageFilter.php">
				<fieldset>
					<legend>Job Listings</legend>
						<select name="Homepage">
							<?php
								if(!($stmt = $mysqli->prepare("SELECT j.job_id, j.job_name, j.job_emp, j.job_desc, j.job_pay, s.skill_id, s.skill_name 
																FROM job j 
																INNER JOIN job_skills js ON j.job_id = js.job_id
																INNER JOIN skills s ON js.skill_id = s.skill_id
																INNER JOIN user_skills us ON s.skill_id = us.skill_id
																INNER JOIN usr_db u ON us.user_id = u.user_id
																GROUP BY s.skill_name"))){
									echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
								}

								if(!$stmt->execute()){
									echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
								}
								if(!$stmt->bind_result($job_id, $job_name, $job_emp, $job_desc, $job_pay, $skill_id, $skill_name)){
									echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
								}
								while($stmt->fetch()){
									echo '<option value=" '. $skill_id . ' "> ' . $skill_name . '</option>\n';
								}
								$stmt->close();									
							?>
						</select>
				</fieldset>
				<input type="submit" value="Run Search" />
			</form>
		</div>
		
		<?php
			$username = "sampleuser1";
			$_SESSION['username'] = "sampleuser1";
			if(!($stmt = $mysqli->prepare("SELECT j.job_name, j.job_emp, j.job_desc, j.job_pay, s.skill_name 
											FROM job j 
											INNER JOIN job_skills js ON j.job_id = js.job_id
											INNER JOIN skills s ON js.skill_id = s.skill_id
											INNER JOIN user_skills us ON s.skill_id = us.skill_id
											INNER JOIN usr_db u ON us.user_id = u.user_id
											WHERE u.username = ?
											GROUP BY j.job_id"))){
				echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
			}
			
			$stmt->bind_param("s", $_SESSION['username']);

			if(!$stmt->execute()){
				echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			if(!$stmt->bind_result($job_name, $job_emp, $job_desc, $job_pay, $skill_name)){
				echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
			}
			while($stmt->fetch()){
				echo "<tr>\n<td>\n" . $job_name . "\n</td>\n<td>\n" . $job_emp . "\n</td>\n<td>\n" 
									. $job_desc . "\n</td>\n<td>\n" . $job_pay . "\n</td>\n<td>\n"
									. $skill_name . "\n</td>\n</tr>";
			}
			$stmt->close();
		?>
	</table>
</div>
</body>
</html>
