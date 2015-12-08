<?php

echo "<table><th>Fund Name</th><th>Most Recent Price</th><th>Manager Name</th><th>Buy Fund</th><th>View Fund Information</th>";
$db = new mysqli('stardock.cs.virginia.edu','cs4750npb3ux','fall2015','cs4750npb3ux');
$getStockTable = "select distinct name, price, Full_name from Fund, Fund_Shares, Users, Manager where Fund.name = Fund_Shares.fund_name and Manager.manager_id = Fund.manager_id and Manager.Email = Users.Email;";
$result = $db->query($getStockTable);
while($row = $result->fetch_assoc()):
	echo "<tr>";
	echo "<td>".$row["name"]."</td>"."<td>".$row["price"]."</td><td>".$row["Full_name"]."</td>";
	echo '<td><input type="button" value="Buy" name="'.$row["name"].'" onclick="buyFunds(this)"></td>';
	echo '<td><input type="button" value="View" name="'.$row["name"].'" onclick="showFundInfo(this)"></td>';
	echo "</tr>";
endwhile;
echo "</table>";

?>