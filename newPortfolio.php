<?php

session_start();

$name = $_POST['portName'];
$email = $_SESSION['email'];

$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$getID = "select customer_id from Investor where Email = '$email';";
$result = $db->query($getID);
$row = $result->fetch_assoc();
$custID = $row["customer_id"];
//echo $custId;
$createNewPort = "insert into Portfolio values('$name','$custID',0,0);";
$db->query($createNewPort);
?>