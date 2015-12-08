<?php
session_start();
$email = $_SESSION['email'];

$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$name = $_POST["name"];
$quantity = $_POST["quantity"];
$port = $_POST["port"];
$price = $_POST["price"];

$query = "delete from Shares where portfolio_name = '$port' and name = '$name' and quantity = $quantity;";
$db->query($query);

###Get Variables

$getID = "select customer_id from Investor where Email = '$email';";
$result = $db->query($getID);
$row = $result->fetch_assoc();
$custID = $row["customer_id"];

$getCurDate = "select max(date) as date, close from stock where name='$name';";
$result = $db->query($getCurDate);
$row = $result->fetch_assoc();
$curDate = $row["date"];

//add to transaction history
$transaction_history_update = "insert into Transaction_History (type,customer_id,symbol,quantity,transaction_date) values(0,'$custID','$name',$quantity,'$curDate');";
$db->query($transaction_history_update);

$updateNetWorth = "update Portfolio set net_worth = net_worth - $quantity * $price where portfolio_name = '$port';";
$db->query($updateNetWorth);
echo "Stocks sold!";





?>