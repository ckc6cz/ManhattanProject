<?php
session_start();
$email = $_POST["email"];
$password = $_POST["password"];

$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$query = "select * from Users where Email = '$email';";
$result = $db->query($query);
$found = False;
while($row = $result->fetch_assoc()):
	if($row["password"] == $password):
		$_SESSION["email"] = $email;
		$_SESSION["logged_in"] = 1;
		$_SESSION["Full_name"] = $row["Full_name"];
		//$_SESSION["role"] = "investor";
		//header("Location:investor_lp.php");
		if ($row["m_i"] == 1) {
			$_SESSION["role"] = "manager";
			$query = "select * from Manager where Email = '$email'";
			$newResult = $db->query($query) or die ("Invalid here: " . $db->error);
			while($newRow = $newResult->fetch_assoc()):
				$_SESSION["manager_id"] = $newRow["Manager_id"];
			endwhile;
			header("Location:manager_lp.php");
		} else {
			$_SESSION["role"] = "investor";
			$query = "select * from Investor where Email = '$email'";
			$newResult = $db->query($query) or die ("Invalid: " . $db->error);
			while($newRow = $newResult->fetch_assoc()):
				$_SESSION["investor_id"] = $newRow["Customer_id"];
				$_SESSION["manager_id"] = $newRow["Manager_id"];
			endwhile;
			header("Location:investor_lp.php");
		}
		//echo "found";
		$found = True;
		break;
	endif;
endwhile;
if(!$found):
	$_SESSION["loginfail"] = 1;
	//echo "not found";
	header("Location:LogInDB.php");
endif;

?>