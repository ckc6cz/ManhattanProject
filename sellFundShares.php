<?php

$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$name = $_POST["name"];
$quantity = $_POST["quantity"];
$fund = $_POST["fund"];
$price = $_POST["price"];

$query = "delete from Fund_Shares where fund_name = '$fund' and symbol = '$name' and quantity = $quantity;";
$db->query($query);

$updateNetWorth = "update Fund set total_value = total_value - $quantity * $price where name = '$fund';";
$db->query($updateNetWorth);
echo "Stocks sold!";
?>