<?php
session_start();
$email = $_SESSION['email'];


$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');

$getID = "select customer_id from Investor where Email = '$email';";
$result = $db->query($getID);
$row = $result->fetch_assoc();
$custID = $row["customer_id"];

$query = "select * from Transaction_History where customer_id = $custID; ";


$fail = 0;
$result = $db->query($query) or $fail = 1;

if ($fail == 0) {
	echo "<table><th>Transaction ID</th><th>Type</th><th>Symbol</th><th>Quantity</th><th>Date</th>";

	while($row = $result->fetch_assoc()):
		echo "<tr>";
		echo "<td>".$row["id"]."</td>";
		if($row["type"]==1):
			echo "<td>Bought</td>";
		else:
			echo "<td>Sold</td>";
		endif;
		echo "<td>".$row["symbol"]."</td>";
		echo "<td>".$row["quantity"]."</td>";
		echo "<td>".$row["transaction_date"]."</td>";
		echo "</tr>";
	endwhile;

	echo "</table>";
} else {
	echo "<h1> No transaction history! </h1>";
}


?>