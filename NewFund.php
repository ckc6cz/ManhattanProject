<?php

session_start();
$name = $_POST["name"];
$id = $_SESSION["manager_id"];

$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$newFund ="insert into Fund values('$name', '$id' ,0,0,1000);";

$db->query($newFund);

echo "";
?>