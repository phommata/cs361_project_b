<?php
require "./db_connect.php";
require "./profile_page_functions.php";
//THIS LINE NEEDS TO BE CHANGED TO $usr = $_SESSION['username'];
$usr = "sampleuser1";


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Profile</title>

	<link rel="stylesheet" href="stylesheets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="stylesheets/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="stylesheets/bootstrap/css/docs.min.css">
	

</head>
<body>
<div class="container">
	<h2 class="pageHeader">Edit Profile</h2>
	<legend>Current Profile</legend>
		<?php
      
        $html_str = load_profile ($mysqli, $usr);
        echo $html_str;
        ?>
       </p>
	<legend>Add/Remove Items</legend>
        <form   class="form " 
                action="update_profile.php" method="POST">
        <fieldset>
   
            <div class="controls controls-row">
                <p class="lead">BIO</p>
                <textarea 
                    name="bio" 
                    id="bio" 
                    rows="4"
                    cols="50"
                    placeholder="update bio...">update bio...
                </textarea>
                <p class="lead">EXPERIENCE</p>
                <textarea 
                    name="experience" 
                    id="experience" 
                    rows="4"
                    cols="50"
                    placeholder="update experience...">update experience...
                </textarea>
                <p class="lead">SKILLS</p>
                <select class="form-control" name="skills" data-toggle='tooltip' data-placement='top' title='' data-original-title='skills'>
                    <option value="C++">C++</option>
                    <option value="Java">Java</option>
                    <option value="JavaScript">JavaScript</option>
                </select>
                <select name="rating" class="form-control" data-toggle='tooltip' data-placement='top' title='' data-original-title='skill rating'>
                    <option value="1">1 - Low</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5 - Expert</option>
                </select>
                <br>

                <button class="btn btn-primary span2" type="submit">Update</button>
            </div>
        </fieldset>
    </form>
    <br><br>
	

<?php


?>

</div>

<script src="stylesheets/bootstrap/js/jquery-1.11.0.min.js"></script>
<script src="stylesheets/bootstrap/js/bootstrap.min.js"></script>	
</body>
</html>