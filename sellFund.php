<?php

$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$name = $_POST["name"];
$quantity = $_POST["quantity"];
$port = $_POST["port"];
$price = $_POST["price"];

$query = "delete from Funds_For_Investors where portfolio_name = '$port' and name = '$name' and quantity = $quantity;";
$db->query($query);

$updateNetWorth = "update Portfolio set net_worth = net_worth - $quantity * $price where portfolio_name = '$port';";
$db->query($updateNetWorth);
echo "Shares sold!";
?>