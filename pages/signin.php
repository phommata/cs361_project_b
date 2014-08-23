<?php
ini_set('display_errors', 'On');
session_start();

if (isset($_SESSION['logged_in_status'])){
  header('Location: ./landing_page.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>sign in</title>

	<link rel="stylesheet" href="stylesheets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="stylesheets/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="stylesheets/bootstrap/css/docs.min.css">
	<link rel="stylesheet" href="stylesheets/bootstrap/css/signin.css">
	

</head>
<body>
	<form id="signin" class="form-signin" role="form" action="index.php?check=1" method="post">
        <div id="badLoginMessage">
        </div>
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" name="username" class="form-control" placeholder="username" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="password" required>
        <button class="btn btn-lg btn-primary btn-block" id="signmein">Sign in</button>
        <a class="small" href="./signup.php">Register</a>
      </form>

    </div> <!-- /container -->

    <script>
    $(document).ready(function() {
      //sign in action
      $("#signmein").click(function() {
        trySignin();
        event.preventDefault();
      });
    });

    function trySignin() {
      var formData = $("#signin").serialize();
      $.ajax({
            type: "POST",
            url: "login.php",
            data: formData,
            success: function( data ) {  
              if (data != 1) {
                printError();
              }
              else
                window.location.replace('../landing_page/index.php');
            },
            dataType: "html"
          });
    }
    </script>
	
</body>
</html>