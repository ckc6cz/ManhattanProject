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
$buyStock = "insert into Shares values('$name',$quant,'$port','$curDate');";

$db->query($buyStock);

//Now add to net worth of portfolio
$updateNetWorth = "update Portfolio set net_worth = net_worth + $purPrice * $quant where portfolio_name = '$port';";
$db->query($updateNetWorth);

###Get Variables

$getID = "select customer_id from Investor where Email = '$investor_email';";
$result = $db->query($getID);
$row = $result->fetch_assoc();
$custID = $row["customer_id"];

$getCurDate = "select max(date) as date, close from stock where name='$name';";
$result = $db->query($getCurDate);
$row = $result->fetch_assoc();
$curDate = $row["date"];

//Add to transaction history
$transaction_history_update = "insert into Transaction_History (type,customer_id,symbol,quantity,transaction_date) values(1,'$custID','$name',$quant,'$curDate');";
$db->query($transaction_history_update);
//echo $buyStock;

echo "<h1>Successfully Added Stocks to Portfolio</h1>";

?>