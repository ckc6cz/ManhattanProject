<?php

session_start();
$email = $_SESSION['email'];
$name = $_POST['portName'];
if ($_SESSION["role"] == "investor") {
	echo "<h1 align='left'> Stocks </h1>";
	echo "<table><th>Ticket Name</th><th>Quantity</th><th>Purchase Price</th><th>Current Price</th><th>Total Value</th><th>Gain/Loss</th><th>Sell</th>";
	$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
	$getTable = "select * from stock natural join Shares natural join Portfolio natural join Investor where stock.date = Shares.date_of_purchase AND Shares.portfolio_name = Portfolio.portfolio_name AND Portfolio.portfolio_name = '$name'";
	$result = $db->query($getTable);

	while($row = $result->fetch_assoc()):
		// get current price of each stock
		$getPrice = "select max(date) as date, close from stock where name ='". $row["name"]."'";
		$priceResult = $db->query($getPrice);
		$priceAssoc = $priceResult->fetch_assoc();

		//get purchase price
		$getPurPrice = "select close from stock where name = '".$row["name"]."' and date = '".$row["date_of_purchase"]."'";
		$purPriceResult = $db->query($getPurPrice);
		$purPriceAssoc = $purPriceResult->fetch_assoc();

		// figure out total value
		$totVal = round($priceAssoc["close"] * $row["quantity"], 2);
		$totStartVal = round($purPriceAssoc["close"] * $row["quantity"], 2);
		$change = round((($totVal - $totStartVal) / $totStartVal * 100), 2);
		echo "<tr>";
		echo "<td>".$row["name"]."</td>"."<td>".$row["quantity"]."</td><td>\$". $purPriceAssoc["close"]. "</td><td>\$". $priceAssoc["close"] . "</td>";
		echo "<td>\$$totVal</td><td>$change%</td>";
		echo '<td><input type="button" value="Sell" name="'.$row["name"].'" onclick="sellStocks(this,'.$row["quantity"].',\''.$name.'\', '.$priceAssoc["close"].')"></td>';
		echo "</tr>";
	endwhile;
	echo "</table>";


	echo "<h1 align='left'> Funds </h1>";
	echo "<table><th>Fund Name</th><th>Quantity</th><th>Current Price</th><th>Total Value</th><th>Sell</th>";
	$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
	$getTable = "select * from Funds_For_Investors natural join Fund where portfolio_name = '$name';";
	$result = $db->query($getTable);

	while($row = $result->fetch_assoc()):
		// get current price of each fund
		$getPrice = "select price from Fund where name = '".$row["name"]."';";
		$priceResult = $db->query($getPrice);
		$priceAssoc = $priceResult->fetch_assoc();

		// figure out total value
		$totVal = round($priceAssoc["price"] * $row["quantity"], 2);
		echo "<tr>";
		echo "<td>".$row["name"]."</td>"."<td>".$row["quantity"]."</td><td>\$".$priceAssoc["price"]."</td>";
		echo "<td>\$$totVal</td>";
		echo '<td><input type="button" value="Sell" name="'.$row["name"].'" onclick="sellFunds(this,'.$row["quantity"].',\''.$name.'\', '.$priceAssoc["price"].')"></td>';
		echo "</tr>";
	endwhile;

	echo "</table>";
} else {
	echo "<table><th>Ticket Name</th><th>Quantity</th><th>Purchase Price</th><th>Current Price</th><th>Total Value</th><th>Gain/Loss</th>";
	$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
	$getTable = "select * from stock natural join Shares natural join Portfolio natural join Investor where stock.date = Shares.date_of_purchase AND Shares.portfolio_name = Portfolio.portfolio_name AND Portfolio.portfolio_name = '$name'";
	$result = $db->query($getTable);

	while($row = $result->fetch_assoc()):
		// get current price of each stock
		$getPrice = "select max(date) as date, close from stock where name ='". $row["name"]."'";
		$priceResult = $db->query($getPrice);
		$priceAssoc = $priceResult->fetch_assoc();

		//get purchase price
		$getPurPrice = "select close from stock where name = '".$row["name"]."' and date = '".$row["date_of_purchase"]."'";
		$purPriceResult = $db->query($getPurPrice);
		$purPriceAssoc = $purPriceResult->fetch_assoc();

		// figure out total value
		$totVal = round($priceAssoc["close"] * $row["quantity"], 2);
		$totStartVal = round($purPriceAssoc["close"] * $row["quantity"], 2);
		$change = round((($totVal - $totStartVal) / $totStartVal * 100), 2);
		echo "<tr>";
		echo "<td>".$row["name"]."</td>"."<td>".$row["quantity"]."</td><td>\$". $purPriceAssoc["close"]. "</td><td>\$". $priceAssoc["close"] . "</td>";
		echo "<td>\$$totVal</td><td>$change%</td>";
		echo "</tr>";
	endwhile;
}


?>