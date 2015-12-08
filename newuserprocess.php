<?php

$email = $_POST["email"];
$password = $_POST["password"];
$name = $_POST["name"];
$dob = $_POST["DOB"];
$role = $_POST["role"];

$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
if($role == "Investor"):
	$query = "insert into Users values('$name', '$dob','$email','$password',0);";
else:
	$query = "insert into Users values('$name', '$dob','$email','$password',1);";
endif;
$db->query($query);
echo $query;
//header("Location:LogInDB.php");


?>