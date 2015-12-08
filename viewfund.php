<?php

session_start();
$email = $_SESSION['email'];
$name = $_POST['name'];

echo "<table><th>Ticket Name</th><th>Quantity</th><th>Purchase Price</th><th>Current Price</th><th>Total Value</th><th>Gain/Loss</th><th>Sell</th>";
$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$getTable = "select * from Fund_Shares where fund_name = '$name'";
$result = $db->query($getTable);

while($row = $result->fetch_assoc()):
	// get current price of each stock
	$getPrice = "select max(date) as date, close from stock where name ='". $row["symbol"]."'";
	$priceResult = $db->query($getPrice);
	$priceAssoc = $priceResult->fetch_assoc();

	//get purchase price
	$getPurPrice = "select close from stock where name = '".$row["symbol"]."' and date = '".$row["date_of_purchase"]."'";
	$purPriceResult = $db->query($getPurPrice);
	$purPriceAssoc = $purPriceResult->fetch_assoc();

	// figure out total value
	$totVal = round($priceAssoc["close"] * $row["quantity"], 2);
	$totStartVal = round($purPriceAssoc["close"] * $row["quantity"], 2);
	$change = round((($totVal - $totStartVal) / $totStartVal * 100), 2);
	echo "<tr>";
	echo "<td>".$row["symbol"]."</td>"."<td>".$row["quantity"]."</td><td>\$". $purPriceAssoc["close"]. "</td><td>\$". $priceAssoc["close"] . "</td>";
	echo "<td>\$$totVal</td><td>$change%</td>";
	echo '<td><input type="button" value="Sell" name="'.$row["symbol"].'" onclick="sellFundShares(this,'.$row["quantity"].',\''.$name.'\', '.$priceAssoc["close"].')"></td>';
	echo "</tr>";
endwhile;
?>