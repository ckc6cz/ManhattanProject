<?php

echo "<table><th>Ticket Name</th><th>Most Recent Price</th><th>Buy Stock</th><th>View Stock Performance</th><th>Business information</th>";
$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$getStockTable = "select name, close from stock where date in( select max(date) from stock)group by name;";
$result = $db->query($getStockTable);
while($row = $result->fetch_assoc()):
	echo "<tr>";
	echo "<td>".$row["name"]."</td>"."<td>".$row["close"]."</td>";
	echo '<td><input type="button" value="Buy" name="'.$row["name"].'" onclick="buyStocks(this)"></td>';
	echo '<td><input type="button" value="Performance Graph" name="'.$row["name"].'" onclick="stockPerformanceGraphing(this)"></td>';
	echo '<td><input type="button" value="View Info" name="'.$row["name"].'" onclick="showBizInfo(this)"></td>';
	echo "</tr>";
endwhile;
echo "</table>";

?>