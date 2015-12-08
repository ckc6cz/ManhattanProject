<?php
	session_start();
	if(isset($_SESSION["email"])):
		//if($_SESSION["role"]=="investor"):
			header("Location:investor_lp.php");
		//endif;
	else:
		if(isset($_SESSION["loginfail"])):
			echo "You have entered an incorrect email/password combination.";
		endif;
		
?>

<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="dbstyles.css">
	<link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class = "box">
		<h1>Welcome!</h1>
		
	</div>
	<div class="box">
		<form method = "POST" action = "loginprocess.php">
			<p>Email: </p>
			<input type = "text" name="email"></br></br>
			<p>Password: </p>
			<input type = "text" name="password"></br></br>
			<input class = "button" type = "submit" value="Log-In"></br></br>
		</form>
	</div>
</div>
</body>
</html>






<?php
	endif;
?>