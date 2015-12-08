
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="dbstyles.css">
	<link href='https://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class = "box">
		<h1>Sign-Up Here</h1>
	</div>
	<div class="box">
		<form method = "POST" action = "newuserprocess.php">
			<p>Email: </p>
			<input type = "text" name="email"></br></br>
			<p>Password: </p>
			<input type = "text" name="password"></br></br>
			<p>Full Name: </p>
			<input type = "text" name="name"></br></br>
			<p>Date of Birth (YYYY-MM-DD): </p>
			<input type = "text" name="DOB"></br></br>
			<select name="role" >
 				 <option value="Investor">Investor</option>
 				 <option value="Manager">Manager</option>
			</select>
			<input class = "button" type = "submit" value="Register"></br></br>
		</form>
	</div>
</div>
</body>
</html>





