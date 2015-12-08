<?php

session_start();
$investor_email = $_SESSION["email"];
$name = $_POST["name"];
$quant = $_POST["quant"];
$port = $_POST["port"];

$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$getCurDate = "select max(date) as date from stock;";
$result = $db->query($getCurDate);
$row = $result->fetch_assoc();
$curDate = $row["date"];

$getPrice = "select price from Fund where name = '$name';";
$result = $db->query($getPrice);
$row = $result->fetch_assoc();

$purPrice = $row["price"];
//Insert into shares table
$buyStock = "insert into Funds_For_Investors values('$name',$quant,'$port','$curDate');";
$didntWork = 0;
$db->query($buyStock) or $didntWork = 1;

if ($didntWork != 1) {
	//Now add to net worth of portfolio
	$updateNetWorth = "update Portfolio set net_worth = net_worth + $purPrice * $quant where portfolio_name = '$port';";
	$db->query($updateNetWorth);

	//echo $buyStock;
	echo "<h1>Successfully Added Fund to Portfolio</h1>";
} else {
	echo "<h1> You can't buy that many shares of this fund! </h1>";
}
?>