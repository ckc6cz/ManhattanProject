<?php

session_start();
$investor_email = $_SESSION["email"];
$name = $_POST["name"];
$quant = $_POST["quant"];
$port = $_POST["port"];

$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$getCurDate = "select max(date) as date, close from stock where name='$name';";
$result = $db->query($getCurDate);
$row = $result->fetch_assoc();
$curDate = $row["date"];
$purPrice = $row["close"];
//Insert into shares table
$buyStock = "insert into Fund_Shares values('$port','$name',$quant,'$curDate');";

$db->query($buyStock);

//Now add to net worth of portfolio

$updateNetWorth = "update Fund set total_value = total_value + $purPrice * $quant where name = '$port';";
$db->query($updateNetWorth);

//echo $buyStock;
echo "Successfully Added Stocks to Fund";

?>