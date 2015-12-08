<?php
session_start();
$email = $_SESSION['email'];

echo "<table><th>Portfolio Name</th><th>Net Worth</th><th>View Portfolio</th>";
$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$getStockTable = "select portfolio_name, net_worth from Investor natural join Portfolio where email = '$email'";
$result = $db->query($getStockTable);
while($row = $result->fetch_assoc()):
	echo "<tr>";
	echo "<td>".$row["portfolio_name"]."</td>"."<td>".$row["net_worth"]."</td>";
	echo '<td><input type="button" value="View" name="'.$row["portfolio_name"].'" onclick="ViewPortfolio(this)"></td>';
	echo "</tr>";
endwhile;
echo "<tr><td></td><td></td>";
echo'<td><input type="button" value="New Portfolio" name="createNew" onclick="CreatePortfolio(this)"></td>';
echo "</table>";

?>