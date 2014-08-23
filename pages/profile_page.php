<?php


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
	<h1 class="pageHeader">Edit Profile</h1>
	<legend>Current Profile</legend>
		<p class="lead">bio</p>
        <p id="message">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia aliquid perspiciatis commodi rerum quisquam consequatur vero laborum repudiandae similique facere quod pariatur maiores, blanditiis veniam cum soluta id doloribus, facilis.</p>
		<p class="lead">experience</p>
        <p id="message">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia aliquid perspiciatis commodi rerum quisquam consequatur vero laborum repudiandae similique facere quod pariatur maiores, blanditiis veniam cum soluta id doloribus, facilis.</p>
		<p class="lead">skills</p>
        <p id="message">
        <ul>
        	<li>
        		php  
        		<span class="glyphicon glyphicon-star"></span>
        		<span class="glyphicon glyphicon-star"></span>
        		<span class="glyphicon glyphicon-star"></span>
        		<span class="glyphicon glyphicon-star"></span>
        		<span class="glyphicon glyphicon-star-empty"></span>
        	</li>
        	<li>ruby on rails
        		<span class="glyphicon glyphicon-star"></span>
        		<span class="glyphicon glyphicon-star"></span>
        		<span class="glyphicon glyphicon-star"></span>
        		<span class="glyphicon glyphicon-star-empty"></span>
        		<span class="glyphicon glyphicon-star-empty"></span>
        	</li>
        	<li>c#
        		<span class="glyphicon glyphicon-star"></span>
        		<span class="glyphicon glyphicon-star-empty"></span>
        		<span class="glyphicon glyphicon-star-empty"></span>
        		<span class="glyphicon glyphicon-star-empty"></span>
        		<span class="glyphicon glyphicon-star-empty"></span>
        	</li>
        </ul>
       </p>
	<legend>Add/Remove Items</legend>
        <form class="form form-inline" action="add_education.php" method="POST">
        <fieldset>
        <p>Add a degree</p>
            <div class="controls controls-row">
                <select class="form-control required" name="degree" data-toggle='tooltip' data-placement='top' title='' data-original-title='degree'>
                    <option value='BA'>BA</option>
                    <option value='BS'>BS</option>
                    <option value='MA'>MA</option>
                    <option value='MS'>MS</option>
                    <option value='MA'>MA</option>
                    <option value='MBA'>MBA</option>
                    <option value='PhD'>PhD</option>
                    <option value='MD'>MD</option>
                    <option value='EdD'>EdD</option>
                    <option value='JD'>JD</option>
                </select>

                <input type="text" name="area" placeholder="concentration" class="form-control" >
                <?php
                    echo "<select class='form-control required' name='class_of' placeholder='class year' data-toggle='tooltip' data-placement='top' title='' data-original-title='year of graduation'>";
                        $grad_year = date("Y");
                        for ($i=$grad_year; $i >= 1880; $i--) {
                            echo "<option value = '".$i."' >".$i."</option>\n";
                        }
                        echo "</select>";
                ?>
                <button class="btn btn-primary span2" type="submit">Update</button>
            </div>
        </fieldset>
    </form>
	

<?php


?>

</div>

<script src="stylesheets/bootstrap/js/jquery-1.11.0.min.js"></script>
<script src="stylesheets/bootstrap/js/bootstrap.min.js"></script>	
</body>
</html>