<?php
session_start();
$email = $_SESSION['email'];

echo "<table><th>Fund Name</th><th>Net Worth</th><th>Price</th><th>View Fund</th>";
$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$getFundTable = "select Fund.name, total_value, price from Manager natural join Fund where email = '$email'";
$result = $db->query($getFundTable);
while($row = $result->fetch_assoc()):
	echo "<tr>";
	echo "<td>".$row["name"]."</td>"."<td>$".$row["total_value"]."</td><td>$".$row["price"]."</td>";
	echo '<td><input type="button" value="View" name="'.$row["name"].'" onclick="ViewFund(this)"></td>';
	echo "</tr>";
endwhile;
echo "<tr><td></td><td></td><td></td>";
echo'<td><input type="button" value="New Fund" name="createFund" onclick="CreateFund()"></td>';
echo "</table>";

?>