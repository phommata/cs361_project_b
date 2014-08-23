<?php


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
	<form action="index.php" method="POST">
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