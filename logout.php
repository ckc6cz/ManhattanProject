<?php
	session_start();
	session_destroy();
	header("Location:LogInDB.php");
?>